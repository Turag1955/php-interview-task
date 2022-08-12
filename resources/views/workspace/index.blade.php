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
                @if(!blank($workspaces) && $workspaces)
                @foreach($workspaces as $val)
                <a href="{{ route('board.index',$val->id) }}"
                    class="list-group-item list-group-item-action {{ request()->is('board/'.$val->id) ? 'active' : '' }}">
                    <i class="fa fa-bars"></i>&nbsp;{{ $val->displayName }}</a>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    @yield('workspace.layout')
</div>
@include('workspace.workspace-modal')
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".btn-workspace").click(function () {
            $("#workspace").modal('show');
        });
    });

</script>
@endsection
