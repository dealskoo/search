@extends('admin::layouts.panel')
@section('title',__('search::search.searches_list'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{ __('admin::admin.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('admin::admin.settings') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('search::search.searches_list') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('search::search.searches_list') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->canDo('searches.create'))
                        <div class="row mb-2">
                            <div class="col-12">
                                <a href="{{ route('admin.searches.create') }}" class="btn btn-danger mb-2"><i
                                        class="mdi mdi-plus-circle me-2"></i> {{ __('search::search.add_search') }}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="searches_table" class="table table-centered w-100 dt-responsive nowrap">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('search::search.id') }}</th>
                                <th>{{ __('search::search.name') }}</th>
                                <th>{{ __('search::search.country') }}</th>
                                <th>{{ __('search::search.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            let table = $('#searches_table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.searches.index') }}",
                "language": language,
                "pageLength": pageLength,
                "columns": [
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': true},
                    {'orderable': false},
                ],
                "order": [[0, "desc"]],
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                    $('#searches_table tr td:nth-child(4)').addClass('table-action');
                    delete_listener();
                }
            });

            table.on('childRow.dt', function (e, row) {
                delete_listener();
            });
        });
    </script>
@endsection
