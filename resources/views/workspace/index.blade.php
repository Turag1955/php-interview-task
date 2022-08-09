@extends('layouts.master')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Store Report') }}</h1>
        {{ Breadcrumbs::render('store-report') }}
    </div>

    <div class="section-body">
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
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Employees</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

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
                        <label>{{ __('Workspace Name') }}</label>
                        <input type="text" name="displayName" id="displayName"
                            class="form-control @error('displayName') is-invalid @enderror"
                            value="{{ old('displayName') }}" required>
                        @error('displayName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
