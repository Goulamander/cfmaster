@extends('layouts.app')
@section('title')
    Products
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- <button class="btn btn-info btn-round">Product 1</button> --}}
            <div class="product_list"></div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">inventory_2</i>
                    </div>
                    <h4 class="card-title product-name"></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="row">
                                <label class="col-6 currentlyinstock">Currently in stock</label>
                                <div class="col-6">
                                    <div class="input-group">
                                        <input class="form-control  text-center currentStock" max="10000" type="text" data-id=""
                                            value="0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Units
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <br>
                        </div>
                        <div class="col-sm-5 ml-5">
                            <button class="btn btn-success col btn-sm editproduct" onclick="editproductconfig()"
                                data-toggle="modal" data-target="#product_create">
                                <span class="btn-label">
                                    <i class="material-icons">settings</i>
                                </span>
                                Product and ordering properties
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title" style="color: #64ccb6;font-weight: normal;">Product Demand and Stocks of
                        <button class="btn" style="background-color: #64ccb6;">
                            <span class="currentYear"></span>
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    @include('components.product_orders')
                    @include('components.earnings_of_Sales')
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title" style="color: #64ccb6;font-weight: normal;">Product Demand and Stocks of
                        <button class="btn" style="background-color: #64ccb6;">
                            <span class="currentYear"></span>
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    @include('components.earnings_of_Sales')
                </div>
            </div>
        </div> --}}
    </div>
    <!-- Modal -->
    @include('components.create_product_model')
@endsection
@section('script')
    <script src="{{ asset('media/js/product-cost.js') }}"></script>
@endsection
