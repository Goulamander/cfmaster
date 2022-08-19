<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;

class StockController extends Controller
{
    public function updateStock(Request $request){
        $stockData = $request->validate([
            'current_stock' => 'required|numeric',
            'product_id' => 'required',
        ]);
        $stockData['user_id'] = Auth::user()->id;
        $store= Stock::where('product_id',$stockData['product_id'])
        ->where('user_id', $stockData['user_id'])
        ->update(['current_stock' => $stockData['current_stock']]);
        return ['message' => 'Stock Updated Successfully.'];
    }
}
