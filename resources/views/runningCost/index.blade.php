@extends('layouts.app')
@section('title')
    Running Cost
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 ">
            <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <p class="card-category">Total Monthly Cost</p>
                    <h3 class="card-title td-price"></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">local_offer</i> Tracked from Running Cost Page
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
                        <div id="running_chart_div" style="width: auto; height: 350px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md ml-auto mr-auto">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">
                        Running Cost
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Description</th>
                                <th>Figure</th>
                                <th>Interval</th>
                                <th>Starting At</th>
                                <th class="text-right">Number of Payments</th>
                                {{-- <th class="text-right">Total Payments</th> --}}
                                <th class="text-right">Action</th>
                            </tr>
                            <tbody class="runningCostTable">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Description</th>
                                    <th>Figure</th>
                                    <th colspan="2">Interval</th>
                                    <th>Starting At</th>
                                    <th class="text-right">Number of Payments</th>
                                    {{-- <th class="text-right">Total Payments</th> --}}
                                </tr>
                                <form id="runningCostEntry">
                                    <tr>
                                        <td> <input type="text" class="form-control" id="description"
                                                placeholder="Enter Description" required>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="material-icons">euro</i></span>
                                                </div>
                                                <input type="number" id="payment_amount" class="form-control figure-cost"
                                                    style="width: 34px;" required>
                                            </div>
                                        </td>
                                        <td colspan="2"> <select class="selectpicker" data-style="select-with-transition"
                                                title="Choose Intervel" data-size="4" id="interval" required
                                                style="width: 34px;">
                                                <option value="1">Monthly </option>
                                                <option value="3">Quartly</option>
                                                <option value="12">Yearly</option>
                                                <option value="6">half</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="form-group bmd-form-group is-filled">
                                                <input type="date" class="form-control datepicker" id="starting_date"
                                                    required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="material-icons">credit_score</i></span>
                                                </div>
                                                <input type="number" class="form-control" id="numberOfPayment"
                                                    style="width: 34px;" placeholder="Number of Payments" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-left">
                                                <button class="btn btn btn-info btn-round" type="submit">
                                                    New Costs<i class="material-icons">add_circle_outline</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </p>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </form>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('media/js/running-cost.js') }}"></script>

    <script type="text/javascript">
        //     google.charts.load('current', {'packages':['line']});
        //       google.charts.setOnLoadCallback(drawChart);

        //     function drawChart() {

        //       var data = new google.visualization.DataTable();
        //       data.addColumn('date', 'X');
        //       data.addColumn('number', 'Figure Cost');

        //       data.addRows([
        //         [new Date('2021-02-01'), 2000],
        //         [new Date('2021-03-01'), 3000],
        //         [new Date('2021-04-01'), 4000],
        //         [new Date('2021-05-01'), 5000],
        //         [new Date('2021-06-01'), 6000],
        //         [new Date('2021-07-01'), 7000],
        //         [new Date('2021-08-01'), 8000],
        //         [new Date('2021-09-01'), 9000],
        //         [new Date('2021-10-01'), 10000],
        //         [new Date('2021-11-01'), 8000],
        //         [new Date('2021-12-01'), 7000],
        //         [new Date('2022-01-01'), 6000],
        //         [new Date('2022-02-01'), 5000],
        //         [new Date('2022-03-01'), 4000],
        //         [new Date('2022-04-01'), 3000]
        //       ]);
        // console.log(data)
        //       var options = {
        //         chart: {
        //           title: 'Its a static Graph, Please give me brief information regarding graph To show information accordingly.',
        //           subtitle: 'in Euro(€)'
        //         },
        //         hAxis: {
        //           title: 'Starting At'
        //         },
        //         vAxis: {
        //           title: 'Total Payment'
        //         },
        //         // width: 1000,
        //         // height: 500
        //       };
        //       var formatter = new google.visualization.NumberFormat(
        //     {prefix: '€', negativeColor: 'red', negativeParens: true});
        // formatter.format(data, 1);
        //       var chart = new google.charts.Line(document.getElementById('chart_div'));

        //       chart.draw(data, google.charts.Line.convertOptions(options));
        //     }
    </script>
@endsection
