@extends('layouts.master')

@section('main-content')

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Settings') }}</h1>
        </div>
    </section>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('trello.store') }}">
                        @csrf
                        <fieldset class="setting-fieldset">
                            <legend class="setting-legend">{{ __('Trello Setting') }}</legend>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="trello_apikey">{{ __('Api Key') }}</label>
                                        <input name="trello_apikey" id="trello_apikey" type="text"
                                            class="form-control {{ $errors->has('trello_apikey') ? ' is-invalid ' : '' }}"
                                            value="{{ old('trello_apikey', setting('trello_apikey')) }}">
                                        @if ($errors->has('trello_apikey'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('trello_apikey') }}
                                        </div>
                                        @endif
                                    </div>
                                    </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="trello_secret_key">{{ __('Secret Key') }}</label>
                                        <input name="trello_secret_key" id="trello_secret_key" type="text"
                                            class="form-control {{ $errors->has('trello_secret_key') ? ' is-invalid ' : '' }}"
                                            value="{{ old('trello_secret_key', setting('trello_secret_key')) }}">
                                        @if ($errors->has('trello_secret_key'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('trello_secret_key') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button class="btn btn-primary">
                                    <span>{{ __('Submit') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
