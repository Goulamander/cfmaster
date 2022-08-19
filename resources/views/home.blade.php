@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 sm-10">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">auto_graph</i>
                    </div>
                    <h4 class="card-title">
                        Statistics
                    </h4>
                </div>
                <div class="card-body ">
                    <div class="tab-pane active" id="dashboard">
                        {{-- <div id="linechart" style="width: 900px; height: 500px"></div> --}}
                        <div id="chart_div" style="width:inherit; height: 500px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 sm-2">
            <div class="card card-nav-tabs ">
                <div class="card-header card-header-info">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item text-center" style="background: #968f97;width:45%">
                                    <a class="nav-link active" href="#home" data-toggle="tab"> Single Entries</a>
                                </li>
                                <li class="nav-item text-center" style="background: #968f97;width:55%">
                                    <a class="nav-link" href="#updates" data-toggle="tab"> Pending payments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="tab-content text-center">
                        <div class="tab-pane active" id="home">
                            @include('components.singleEntry')
                        </div>
                        <div class="tab-pane" id="updates">
                            <p> Under development </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
