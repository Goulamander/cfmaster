<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RunCostEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UniqueSingleEntry;
use Carbon\Carbon;
class CostController extends Controller
{
    public function index()
    {
        return view('runningCost.index');
    }
    public function runningCostEntry(Request $request)
    {
        $entryData = $request->validate([
            'description' => 'required| unique:run_cost_entries',
            'payment_amount' => 'required',
            'interval' => 'required',
            'starting_date' => 'required',
            'numberOfPayment' => 'required',
        ]);
        $entryData['user_id'] = Auth::user()->id;
        $store = RunCostEntry::create($entryData);
        if ($store) {
            return [
                'message' => 'Record Sumitted Successfully',
                'status'  => '200',
            ];
        } else {
            return ['message' => 'error'];
        }
    }
    public function showAllRunningCostEntry()
    {
        $entries = RunCostEntry::where('user_id', '=', Auth::user()->id)->orderby('starting_date','asc')->get();
        $result = [];
        $totalentryamount = 0;
        foreach ($entries as $entry) {
            if ($entry['interval'] == '1') {
                $entry['total_payment'] = $entry['payment_amount'];
                $totalentryamount += $entry['total_payment'];
                $entry['interval'] = 'Monthly';
            } 
            if ($entry['interval'] == '3') {
                $entry['total_payment'] = $entry['payment_amount']/3;
                $totalentryamount += $entry['total_payment'];
                $entry['interval'] = 'Quarterly';
            } 
            if ($entry['interval'] == '6') {
                $entry['total_payment'] = $entry['payment_amount']/6;
                $totalentryamount += $entry['total_payment'];
                $entry['interval'] = 'Half';
            } 
            if ($entry['interval'] == '12') {
                $entry['total_payment'] = $entry['payment_amount']/12;
                $totalentryamount += $entry['total_payment'];
                $entry['interval'] = 'Yearly';
            }
            $result[] = $entry;
        }
        // $totalentryamount = $totalentryamount / 12;
        $totalentryamount = number_format((float)$totalentryamount, 2, '.', '');
        // $totalentryamount = RunCostEntry::where('user_id','=',Auth::user()->id)->sum('payment_amount');
        return  [
            'entries' => $result,
            'totalentryamount' => $totalentryamount
        ];
    }
    public function delete($id)
    {
        RunCostEntry::find($id)->delete();
        return  [
            'message' => 'Record Removed Successfully',
            'status' => '200'
        ];
    }
    public function uniqueCostSingleEntry(Request $request)
    {
        $entryData = $request->validate([
            'description' => 'required',
            'payment_amount' => 'required',
            'entry_date' => 'required'
        ]);
        $entryData['user_id'] = Auth::user()->id;
        $store = UniqueSingleEntry::create($entryData);
        if ($store) {
            return [
                'message' => 'Record Sumitted Successfully',
                'status'  => '200',
            ];
        } else {
            return ['message' => 'error'];
        }
    }
    public function allsingleEntry()
    {
        $result = UniqueSingleEntry::where('user_id', '=', Auth::user()->id)->get();
        return  [
            'singleEntries' => $result
        ];
    }
    public function getSingleEntry($id,Request $request)
    {
        $result = UniqueSingleEntry::where(['user_id'=>Auth::user()->id,'id'=>$id])->first();
        return  [
            'singleEntry' => $result
        ];
    }
    public function updateSingleEntry(Request $request)
    {
        $editEntryData = $request->validate([
            'description' => 'required ',
            'payment_amount' => 'required',
            'entry_date' => 'required',
            'id' => 'required'
        ]);
        $editEntryData['user_id'] = Auth::user()->id;
        $checkProductExist =UniqueSingleEntry::where('id',$editEntryData['id'])->first();
        if($checkProductExist['description'] == $editEntryData['description']){
            $editEntryData['description'] =$checkProductExist['description'];
        }
        else{
            $checkProductNameExistOrNot = UniqueSingleEntry::searchDescription($editEntryData['description']);
                if ($checkProductNameExistOrNot) {
                    return [
                    'message' => 'Single Entry Title Already taken',
                    'status'  => '404',
                ];
            }
        }      
        $result = UniqueSingleEntry::where('id',$editEntryData['id'])
        ->where('user_id', $editEntryData['user_id'])
        ->update($editEntryData);
        return [
            'message' => 'Product Updated Successfully',
            'status'  => '200',
            'result' => $result
        ];
    }
    function deleteSingleEntry($id){
        UniqueSingleEntry::find($id)->delete();
        return  [
            'message' => 'Record Removed Successfully',
            'status' => '200'
        ];
    }
    public function runningstats()
    {
        $id = Auth::user()->id;
        $dataOfRunningCost = DB::select("SELECT *, starting_date, payment_amount FROM `run_cost_entries` WHERE `user_id` = $id  ORDER BY starting_date asc");
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
    public function showSingleRunningCost($id){
        $result = RunCostEntry::where('user_id', '=', Auth::user()->id)
        ->where('id', '=',$id)
        ->first();
        return  [
            $result
        ];
    }
    public function editRunningCost(Request $request){
        $editRunnigCostform = $request->validate([
            'description' => 'required ',
            'payment_amount' => 'required',
            'interval' => 'required',
            'starting_date' => 'required',
            'numberOfPayment' => 'required',
            'id' => 'required'
        ]);
        $editRunnigCostform['user_id']=Auth::user()->id;
        $checkRuningCost=RunCostEntry::where('id',$editRunnigCostform['id'])->first();
        if($checkRuningCost['description']==$editRunnigCostform['description']){
            $editRunnigCostform['description']=$checkRuningCost['description'];
        }
    $result = RunCostEntry::where('id',$editRunnigCostform['id'])
    ->where('user_id', $editRunnigCostform['user_id'])
    ->update($editRunnigCostform);
    return [
            
            'message' => 'Running cost Updated Successfully',
        'status'  => '200',
        'result' => $result
    ];
    }
}

