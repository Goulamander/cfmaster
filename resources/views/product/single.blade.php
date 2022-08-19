@extends('layouts.app')
@section('title')
    Single Product
@endsection
@section('content')
    <div class="row">
        <div class="col-2">
            <div class="card-body text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-info">
                        <i class="material-icons">arrow_back_ios</i>
                        <div class="ripple-container"></div>
                    </button>
                    <button type="button" class="btn btn-info">
                        <i class="material-icons">arrow_forward_ios</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-icon">
                        <i class="material-icons">perm_identity</i>
                    </div>
                    <h4 class="card-title"> List of Products
                        <small class="category"></small>
                    </h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection
