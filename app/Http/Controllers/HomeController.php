<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UniqueSingleEntry;
use App\Models\RunCostEntry;
use App\Http\Controllers\CostController;
use App\Models\EstimateSales;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin != true) {
            $dataofcosts = $this->stats();
            return view('home')->with('visitor', json_encode($dataofcosts));
        } else {
            return view('admin.dashbaord');
        }
    }
    public function stats()
    {
        $id = Auth::user()->id;
        $dataOfRunningCost = DB::select("SELECT
                starting_date,
                payment_amount,
                `interval`,
                `numberOfPayment`
                
            FROM
                `run_cost_entries`
            WHERE
                `user_id` = $id
            UNION ALL
            SELECT
                entry_date AS starting_date,
                payment_amount,
                deleted_at AS `interval`,
                updated_at AS `numberOfPayment`
            FROM
                `unique_single_entries`
            WHERE
                `user_id` = $id
            ORDER BY
                starting_date
        ");
        $result = [];
        foreach ($dataOfRunningCost as $value) {
            if ($value->interval == 1) {
                for($i=0;$i <$value->numberOfPayment;$i++){
                    $currentDateTime = new Carbon($value->starting_date);
                    $newDateTime = $currentDateTime->addMonth($i);
                    $newDate = $newDateTime->format('Y-m-d');
                    $runningSet =  ["payment_amount" => $value->payment_amount,
                     "starting_date" => $newDate];
                    array_push($result, $runningSet);
                }
            }
            else if ($value->interval == 3) {
                for($i=0;$i <$value->numberOfPayment;$i++){
                    $currentDateTime = new Carbon($value->starting_date);
                    $newDateTime = $currentDateTime->addMonth($i*3);
                    $newDate = $newDateTime->format('Y-m-d');
                    $runningSet =  ["payment_amount" => $value->payment_amount,
                     "starting_date" => $newDate];
                    array_push($result, $runningSet);
                }
            }
            else if ($value->interval == 6) {
                for($i=0;$i <$value->numberOfPayment;$i++){
                    $currentDateTime = new Carbon($value->starting_date);
                    $newDateTime = $currentDateTime->addMonth($i*6);
                    $newDate = $newDateTime->format('Y-m-d');
                    $runningSet =  ["payment_amount" => $value->payment_amount,
                     "starting_date" => $newDate];
                    array_push($result, $runningSet);
                }
            }
            else if ($value->interval == 12) {
                for($i=0;$i <$value->numberOfPayment;$i++){
                    $currentDateTime = new Carbon($value->starting_date);
                    $newDateTime = $currentDateTime->addMonth($i*12);
                    $newDate = $newDateTime->format('Y-m-d');
                    $runningSet =  ["payment_amount" => $value->payment_amount,
                     "starting_date" => $newDate];
                    array_push($result, $runningSet);
                }
            }
            else{
                $currentDateTime = new Carbon($value->starting_date);
                $newDate = $currentDateTime->format('Y-m-d');
                    $runningSet =  ["payment_amount" => $value->payment_amount,
                     "starting_date" => $newDate];
                array_push($result, $runningSet);
            }
        }
        $product_cost = EstimateSales::join('products', 'estimate_sales.product_id', '=', 'products.id')
        ->where('estimate_sales.user_id', Auth::user()->id)
       ->where('products.user_id', Auth::user()->id)
        ->get(['estimate_sales.*', 
            'products.product_name',
            'products.product_name',
            'products.costs_till_ready_to_sell',
            'products.deposit_portion',
            'products.final_payment_portion',
            'products.deposit_leadtime',
            'products.final_payment_leadtime',
            'products.deposit_portion',
            'products.final_payment_portion',
            'products.payment_delay_amazon',
            'products.payout_per_unit_by',
            'products.ppc_cost_per_product'
        ]);
        $inital_cost = [];
        foreach($product_cost as $cost){
            if ($cost->initial_payment_amount != 0) {
                if ($cost->initial_payment_paid == 0) {
                    $date = $cost['entry_year'].'-'.$cost['entry_month'].'-1';
                    $currentDateTime =  new Carbon($date);
                    $newinitial_payment_date = $currentDateTime->subDay($cost['deposit_leadtime'] * 7-1);
                    $initial_payment_date = $newinitial_payment_date->format('Y-m-d');
                    $initial_payment_amount =  -($cost['incoming'] * $cost['costs_till_ready_to_sell']) *$cost['deposit_portion'] / 100;
                    $runningSet =  ["payment_amount" => $initial_payment_amount,
                    "starting_date" => $initial_payment_date];
                    array_push($result, $runningSet);
                }
            }
        }
        foreach($product_cost as $cost){
            if ($cost->final_payment_amount != 0) {
                if ($cost->final_payment_paid == 0) {
                    $date = $cost['entry_year'].'-'.$cost['entry_month'].'-1';
                    $currentDateTime =  new Carbon($date);
                    $newfinal_payment_date = $currentDateTime->subDay($cost['final_payment_leadtime'] * 7-1);
                    $final_payment_date = $newfinal_payment_date->format('Y-m-d');
                    $final_payment_amount =  -($cost['incoming'] * $cost['costs_till_ready_to_sell']) *$cost['final_payment_portion'] / 100;
                    $runningSet =  ["payment_amount" => $final_payment_amount,
                    "starting_date" => $final_payment_date];
                    array_push($result, $runningSet);
                }
            }
        }
        foreach($product_cost as $cost){
            if ($cost->fh_payment_amount != 0 && $cost->fh_payment_paid == 1) {
                    $date = $cost['entry_year'].'-'.$cost['entry_month'].'-1';
                    $currentDateTime4 =  new Carbon($date);
                    $newfh_payment_date = $currentDateTime4->addDays(($cost['payment_delay_amazon']/2) * 7-1);
                    $fh_payment_date = $newfh_payment_date->format('Y-m-d');
                    $fh_payment_amount = (($cost['payout_per_unit_by'] - $cost['ppc_cost_per_product']) *$cost['demand']) / 2;
                    $runningSet =  ["payment_amount" => $fh_payment_amount,
                    "starting_date" => $fh_payment_date];
                    array_push($result, $runningSet);
            }
        }
        foreach($product_cost as $cost){
            if ($cost->sh_payment_amount != 0 && $cost->sh_payment_paid == 1) {
                    $date = $cost['entry_year'].'-'.$cost['entry_month'].'-1';
                    $currentDateTime3 =  new Carbon($date);
                    $newsh_payment_date = $currentDateTime3->addDays(($cost['payment_delay_amazon']) * 7-1);
                    $sh_payment_date = $newsh_payment_date->format('Y-m-d');
                    $sh_payment_amount = (($cost['payout_per_unit_by'] - $cost['ppc_cost_per_product']) *$cost['demand']) / 2;
                    $runningSet =  ["payment_amount" => $sh_payment_amount,
                    "starting_date" => $sh_payment_date];
                    array_push($result, $runningSet);
            }
        }
        // dd($inital_cost);
        $newResult = array_reduce($result, function ($a, $b) {
            isset($a[$b['starting_date']]) ? $a[$b['starting_date']]['payment_amount'] += $b['payment_amount'] : $a[$b['starting_date']] = $b;  
            return $a;
        });
        if (count($result) > 1) {
            $sortarray = array_values($newResult);
            return $sortarray;
        } else {
            $result[] = [0, 0];
            return $result;
        }
    }
}
