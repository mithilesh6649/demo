@extends('adminlte::page')

@section('title', 'Super Admin | Daily Sales Report Details')

@section('content_header')
 
@section('content')

    <div class="rightside_content">
        <div class="container">
            <div class="alert d-none" role="alert" id="flash-message">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table p-0 mb-0">

                            <div class="order_details">
                                <div class="order_heading d-flex align-items-center justify-content-between mb-4">
                                    <h4>Cash Deposite Branch Wise</h4>
                   
                                    <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back</a>
                                </div>

                                <div class="Branch-statement">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/branch_style.css') }}">
@endpush
