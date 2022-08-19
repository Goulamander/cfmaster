<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimateSales;
use Illuminate\Support\Facades\Auth;
class EstimateSalesController extends Controller
{
    public function updateDemandIncomig(Request $request)
    {
        $entryData = $request->validate([
            'month' => 'required',
            'current_year' => 'required',
            'product_id' => 'required',
            'demand' => 'nullable',
            'incoming' => 'nullable',
            'initialAmount' => 'nullable',
            'finalAmount' => 'nullable',
            'initial_payment_date' => 'nullable',
            'final_payment_date' => 'nullable',
            'fh_payment_amount' => 'nullable',
            'sh_payment_amount' => 'nullable',
            'fh_payment_date' => 'nullable',
            'sh_payment_date' => 'nullable',
        ]);
        $message = '';
        // if(!empty($entryData['demand'] &&  $entryData['incoming'])){
        //     $savedvalue = ['demand' =>  $entryData['demand'], 'incoming' => $entryData['incoming']];
        // }
        if(!empty($entryData['demand']) && empty($entryData['incoming'])){
            $savedvalue = [
                'demand' =>  $entryData['demand'],
                'fh_payment_amount' =>  $entryData['fh_payment_amount'],
                'sh_payment_amount' =>  $entryData['sh_payment_amount'],
                'fh_payment_date' =>  $entryData['fh_payment_date'],
                'sh_payment_date' =>  $entryData['sh_payment_date'],
                'fh_payment_paid' =>  0,
                'sh_payment_paid' =>  0,
        ];
            $message = 'Demand Updated!';
        }
        else if(!empty($entryData['incoming'])  && empty($entryData['demand'])){
            $savedvalue = [
                'incoming' =>  $entryData['incoming'],
                'initial_payment_amount' =>  $entryData['initialAmount'],
                'final_payment_amount' =>  $entryData['finalAmount'],
                'initial_payment_date' =>  $entryData['initial_payment_date'],
                'final_payment_date' =>  $entryData['final_payment_date'],
                'initial_payment_paid' => 0,
                'final_payment_paid' => 0,
        ];
            $message = 'Incoming Stock Updated! ';
        }
        else if(isset($entryData['demand']) ){
            $savedvalue = ['demand' =>  0];
            $message = 'Demand Removed!';
        }
        else if(isset($entryData['incoming'])){
            $savedvalue = ['incoming' => 0];
            $message = 'Incoming Stock Removed!';
        }
        $estimateSales = EstimateSales::updateOrCreate(
            [
                'entry_month' => $entryData['month'], 
                'entry_year' => $entryData['current_year'], 
                'product_id' => $entryData['product_id'],
                'user_id' => Auth::user()->id
            ],
            $savedvalue 
        );
        $retrievEstimateSales = EstimateSales::where([
            ['user_id', '=', Auth::user()->id],
            ['entry_year', '=',$request['current_year']],
            ['product_id', '=', $request['product_id']
            ]
        ])->get();
        if($estimateSales){
            return[
                'message' => $message,
                'retrieveDate'=> $retrievEstimateSales
            ];
        } 
    }
    public function getDataOFDemandAndStock(Request $request)
    {
        return EstimateSales::where([
            ['user_id', '=', Auth::user()->id],
            ['entry_year', '=',$request['current_year']],
            ['product_id', '=', $request['product_id']
            ]
        ])->get();
    }
}
