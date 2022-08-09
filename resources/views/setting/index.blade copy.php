@extends('admin.layouts.master')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Settings') }}</h1>

            @yield('admin.setting.breadcrumbs')
        </div>
    </section>

    <div class="row">
        <div class="col-md-3">
            <div class="bg-light card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.setting.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/setting')) ? 'active' : '' }} ">{{ __('setting_menu.site_setting') }}</a>
                    <a href="{{ route('admin.setting.social') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/setting/social')) ? 'active' : '' }}">{{ __('Social Setting') }}</a>
                    <a href="{{ route('admin.setting.editor') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/setting/editor')) ? 'active' : '' }}">{{ __('Editor Setting') }}</a>

                </div>
            </div>
        </div>

        @yield('admin.setting.layout')
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('js/setting/create.js') }}"></script>
@endsection
