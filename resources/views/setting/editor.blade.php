@extends('admin.setting.index')

@section('admin.setting.breadcrumbs')
    {{ Breadcrumbs::render('editor-setting') }}
@endsection

@section('admin.setting.layout')
     <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.setting.editor-update') }}">
                    @csrf
                    <fieldset class="setting-fieldset">
                        <legend class="setting-legend">{{ __('Editor Setting') }}</legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="editor">{{ __('Editor') }} (সম্পাদক)</label>
                                    <input name="editor" id="editor" type="text"
                                        class="form-control {{ $errors->has('editor') ? ' is-invalid ' : '' }}"
                                        value="{{ old('editor', setting('editor')) }}">
                                    @if ($errors->has('editor'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('editor') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="instagram">{{ __('Advisory Editor') }} (উপদেষ্টা সম্পাদক)</label>
                                    <input name="advisory_editor" id="advisory_editor" type="text"
                                        class="form-control {{ $errors->has('advisory_editor') ? ' is-invalid ' : '' }}"
                                        value="{{ old('advisory_editor', setting('advisory_editor')) }}">
                                    @if ($errors->has('advisory_editor'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('advisory_editor') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="managing_editor">{{ __('Managing Editor') }} (ব্যবস্থাপনা সম্পাদক)</label>
                                    <input name="managing_editor" id="managing_editor" type="text"
                                        class="form-control {{ $errors->has('managing_editor') ? ' is-invalid ' : '' }}"
                                        value="{{ old('managing_editor', setting('managing_editor')) }}">
                                    @if ($errors->has('managing_editor'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('managing_editor') }}
                                    </div>
                                    @endif
                                </div>
                      
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <button class="btn btn-primary">
                                <span>{{ __('update Editor Setting') }}</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

