@extends('layouts.master')

@section('main-content')

<section class="section">
    <div class="section-header">
        <h1>{{ __('Store Report') }}</h1>
        {{ Breadcrumbs::render('store-report') }}
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                        {{-- <div class="card-header">
                            <a href="" class="btn btn-icon icon-left btn-primary"><i
                                    class="fas fa-plus"></i> {{ __('Generate Report') }}</a>
                        </div> --}}
                    <div class="card-body">
                        {{-- <div class="table-responsive">
                            <table class="table table-striped" id="maintable">
                                <thead>
                                    <tr>
                                        <th>{{ __('levels.id') }}</th>
                                        <th>{{ __('levels.name') }}</th>
                                        <th>{{ __('levels.status') }}</th>
                                        <th>{{ __('levels.actions') }}</th>
                                    </tr>
                                </thead>
                            </table> --}}
                            <a href="" class="btn btn-icon icon-left btn-primary"><i
                                class="fas fa-plus"></i> {{ __('Generate Report') }}</a>
                        </div>
                    </div>
                </div>
                @if(isset($showView))
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('attendance_report.attendance_report') }}</h5>
                        <button class="btn btn-success btn-sm report-print-button" onclick="printDiv('printablediv')">{{ __('attendance_report.print') }}</button>
                    </div>
                    <div class="card-body" id="printablediv">
                        @if(!blank($attendances))
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('levels.id') }}</th>
                                            <th>{{ __('levels.image') }}</th>
                                            <th>{{ __('attendance_report.user') }}</th>
                                            <th>{{ __('attendance_report.working') }}</th>
                                            <th>{{ __('attendance_report.date') }}</th>
                                            <th>{{ __('attendance_report.clock_in') }}</th>
                                            <th>{{ __('attendance_report.clock_out') }}</th>
                                        </tr>
                                        @php $i =0;@endphp
                                        @foreach($attendances as $attendance)
                                            <tr>
                                                <td>{{$i+=1 }}</td>
                                                <td><figure class="avatar mr-2"><img src="{{$attendance->user->images}}" alt=""></figure></td>
                                                <td>{{ Str::limit(optional($attendance->user)->name, 50)}}</td>
                                                <td>{{ Str::limit($attendance->title, 30) }}</td>
                                                <td>{{$attendance->date}}</td>
                                                @if ($attendance->checkin_time)
                                                    <td>{{$attendance->checkin_time}}</td>
                                                @else
                                                    <td>{{ __('attendance_report.n/a') }}</td>
                                                @endif
                                                @if ($attendance->checkout_time	)
                                                    <td>{{$attendance->checkout_time}}</td>
                                                @else
                                                    <td>{{ __('attendance_report.n/a') }}</td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        @else
                            <h4 class="text-danger">{{ __('attendance_report.data_not_found') }}</h4>
                        @endif
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</section>

@endsection



@section('css')
<link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('assets/modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/category/index.js') }}"></script>
@endsection
