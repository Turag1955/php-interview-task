@extends('layouts.master')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Trello') }}</h1>
        @yield('workspace.breadcrumbs')
    </div>
</section>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-icon icon-left btn-primary btn-workspace"><i
                        class="fas fa-plus"></i>
                    {{ __('Create Workspace') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="bg-light card">
            <div class="list-group list-group-flush">
                {{-- <a href="{{ route('admin.setting.index') }}" class="list-group-item list-group-item-action
                {{ (request()->is('admin/setting')) ? 'active' : '' }} ">{{ __('setting_menu.site_setting') }}</a> --}}
                @if(!blank($workspaces))
                    @foreach($workspaces as $val)
                        <a href="{{ route('board.index',$val->id) }}" class="list-group-item list-group-item-action"> <i class="far fa-user"></i>&nbsp;{{ $val->displayName }}</a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @yield('workspace.layout')
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Lets build a Workspace') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('workspace.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Workspace Name') }}</label><span class="text-danger">*</span>
                        <input type="text" name="displayName" id="displayName"
                            class="form-control"
                            value="{{ old('displayName') }}" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".btn-workspace").click(function () {
            $("#exampleModal").modal('show');
        });
    });

</script>
@endsection
