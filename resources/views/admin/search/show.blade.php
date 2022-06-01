@extends('admin::layouts.panel')

@section('title',__('search::search.view_search'))
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
                        <li class="breadcrumb-item active">{{ __('search::search.view_search') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('search::search.view_search') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">{{ __('search::search.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                   value="{{ old('name',$search->name) }}" autofocus tabindex="1" readonly
                                   placeholder="{{ __('search::search.name_placeholder') }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="country_id"
                                   class="form-label">{{ __('search::search.country') }}</label>
                            <select id="country_id" name="country_id" class="form-control select2" data-toggle="select2" tabindex="3">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                            @if($search->country_id == $country->id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
