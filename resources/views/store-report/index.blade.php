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
                    <div class="card-body">
                        <form action="{{ route('store.report') }}" method="POST">
                            @csrf
                            <button type="submit"  href="" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>
                                {{ __('Generate Report') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            @if(!blank($reports))
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Report (Top Customers by product) ') }}</h5>
                        
                    </div>
                    <div class="card-body" id="printablediv">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">{{ __('Product Name') }}</th>
                                <th scope="col">{{ __('Customer Name') }}</th>
                                <th scope="col">{{ __('Quantity') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col">{{ __('Total') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                     $purchase_quantity = 0;
                                     $product_price = 0;
                                @endphp
                                @foreach ($reports as $report)
                                <tr>
                                    <th scope="row">{{ $report->product_name }}</th>
                                    <td>{{ $report->name }}</td>
                                    <td>{{ $report->purchase_quantity }}</td>
                                    <td>${{ $report->product_price }}</td>
                                    <td>${{ $report->purchase_quantity*$report->product_price }}</td>
                                  </tr>
                                  @php
                                      $purchase_quantity = $report->purchase_quantity + $purchase_quantity;
                                      $product_price = $report->product_price + $product_price;
                                  @endphp
                                @endforeach
                              <tr>
                                <td colspan="2" class="gross-total">{{ __('Gross Total:') }}</td>
                                <td class="gross-total text-left">{{ $purchase_quantity }}</td>
                                <td class="gross-total text-left">${{ $product_price }}</td>
                                <td class="gross-total text-left">${{ $purchase_quantity * $product_price }}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
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
