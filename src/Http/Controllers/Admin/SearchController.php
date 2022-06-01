<?php

namespace Dealskoo\Search\Http\Controllers\Admin;

use Dealskoo\Admin\Http\Controllers\Controller as AdminController;
use Dealskoo\Country\Models\Country;
use Dealskoo\Search\Models\Search;
use Illuminate\Http\Request;

class SearchController extends AdminController
{
    public function index(Request $request)
    {
        abort_if(!$request->user()->canDo('searches.index'), 403);
        if ($request->ajax()) {
            return $this->table($request);
        } else {
            return view('search::admin.search.index');
        }
    }

    private function table(Request $request)
    {
        $start = $request->input('start', 0);
        $limit = $request->input('length', 10);
        $keyword = $request->input('search.value');
        $columns = ['id', 'name', 'country_id'];
        $column = $columns[$request->input('order.0.column', 0)];
        $desc = $request->input('order.0.dir', 'desc');
        $query = Search::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        $query->orderBy($column, $desc);
        $count = $query->count();
        $searches = $query->skip($start)->take($limit)->get();
        $rows = [];
        $can_view = $request->user()->canDo('searches.show');
        $can_edit = $request->user()->canDo('searches.edit');
        $can_destroy = $request->user()->canDo('searches.destroy');
        foreach ($searches as $search) {
            $row = [];
            $row[] = $search->id;
            $row[] = $search->name;
            $row[] = $search->country->name;

            $view_link = '';
            if ($can_view) {
                $view_link = '<a href="' . route('admin.searches.show', $search) . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';
            }

            $edit_link = '';
            if ($can_edit) {
                $edit_link = '<a href="' . route('admin.searches.edit', $search) . '" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
            }
            $destroy_link = '';
            if ($can_destroy) {
                $destroy_link = '<a href="javascript:void(0);" class="action-icon delete-btn" data-table="searches_table" data-url="' . route('admin.searches.destroy', $search) . '"> <i class="mdi mdi-delete"></i></a>';
            }
            $row[] = $view_link . $edit_link . $destroy_link;
            $rows[] = $row;
        }
        return [
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $rows
        ];
    }

    public function show(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('searches.show'), 403);
        $countries = Country::all();
        $search = Search::query()->findOrFail($id);
        return view('search::admin.search.show', ['countries' => $countries, 'search' => $search]);
    }

    public function create(Request $request)
    {
        abort_if(!$request->user()->canDo('searches.create'), 403);
        $countries = Country::all();
        return view('search::admin.search.create', ['countries' => $countries]);
    }

    public function store(Request $request)
    {
        abort_if(!$request->user()->canDo('searches.create'), 403);
        $request->validate([
            'name' => ['required', 'string'],
            'country_id' => ['required', 'exists:countries,id']
        ]);
        $search = new Search($request->only([
            'name',
            'country_id'
        ]));
        $search->save();
        return back()->with('success', __('admin::admin.added_success'));
    }

    public function edit(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('searches.edit'), 403);
        $countries = Country::all();
        $search = Search::query()->findOrFail($id);
        return view('search::admin.search.edit', ['countries' => $countries, 'search' => $search]);
    }

    public function update(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('searches.edit'), 403);
        $request->validate([
            'name' => ['required', 'string'],
            'country_id' => ['required', 'exists:countries,id']
        ]);

        $search = Search::query()->findOrFail($id);
        $search->fill($request->only([
            'name',
            'country_id'
        ]));
        $search->save();
        return back()->with('success', __('admin::admin.update_success'));
    }

    public function destroy(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('searches.destroy'), 403);
        return ['status' => Search::destroy($id)];
    }
}
