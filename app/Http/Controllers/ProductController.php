<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EstimateSales;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest();
        return view('product.index', compact('products'));
    }
    public function store(Request $request)
    {
        $productData = $request->validate([
            'product_name' => 'required',
            'costs_till_ready_to_sell' => 'required',
            'payout_per_unit_by' => 'required',
            'ppc_cost_per_product' => 'required',
            'deposit_portion' => 'required',
            'deposit_leadtime' => 'required',
            'payment_delay_amazon' => 'required',
            'final_payment_portion' => 'required',
            'final_payment_leadtime' => 'required',
            'selling_price_for_sales_tax' => 'required',
        ]);
        if ($productData['deposit_leadtime'] < 0 || $productData['final_payment_leadtime'] < 0) {
            return [
                'message' => 'Negative Value Not Accepted',
                'status'  => '404',
            ];
            exit;
        }
        if ($productData['final_payment_leadtime'] > $productData['deposit_leadtime']) {
            return [
                'message' => 'Required | Deposite Lead-time Greater than Final Payment Lead-time',
                'status'  => '404',
            ];
            exit;
        }
        $productData['user_id'] = Auth::user()->id;
        $checkProductNameExistOrNot = Product::searchProductName($productData['product_name']);
        if ($checkProductNameExistOrNot) {
            return [
                'message' => 'Product name Already Exist',
                'status'  => '404',
            ];
            exit;
        }
        $store = Product::create($productData);
        $currentStock['user_id'] = Auth::user()->id;
        $currentStock['product_id'] = $store->id;
        $storeStock = Stock::create($currentStock);
        for ($i = 1; $i < 13; $i++) {
            $date = date("Y").'-'.$i.'-1';
            $currentDateTime =  new Carbon($date);
            $newinitial_payment_date = $currentDateTime->subDay($productData['deposit_leadtime'] * 7);
            $initial_payment_date = $newinitial_payment_date->format('Y-m-d');
            $newfinal_payment_date =  $currentDateTime->subDay($productData['final_payment_leadtime'] * 7);
            $final_payment_date = $newfinal_payment_date->format('Y-m-d');
            $estimatesalerecord = [
                'user_id' => Auth::user()->id,
                'product_id'  => $store->id,
                'entry_month' => $i,
                'entry_year' => date("Y"),
                'initial_payment_date' => $initial_payment_date,
                'final_payment_date' => $final_payment_date,
                
            ];
            EstimateSales::create($estimatesalerecord);
        }
        if ($store) {
            return [
                'message' => 'success',
                'status'  => '200',
                'newProduct' => $store
            ];
        } else {
            return ['message' => 'error'];
        }
    }
    public function showallproduct()
    {
        $getAllProducts = Product::getallproductname();
        $latest_id = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'asc')->first();
        return [
            'getAllProducts' => $getAllProducts,
            'latest_id'  => $latest_id,
        ];
    }
    public function getSingleUserData($id)
    {
        if ($id == 0) {
            $result['id'] =  0;
            $result['product_name'] = 'No Product Cost Entry Available.';
        } else {
            $result = Product::where('id', "=", $id)->first();
            $stock = Stock::getStockOfSpecificUser($id);
            if (empty($stock)) {
                $stock['current_stock'] = 0;
            }
            $retrievEstimateSales = EstimateSales::where([
                ['user_id', '=', Auth::user()->id],
                ['entry_year', '=', date("Y")],
                ['product_id', '=', $id]
            ])->get();
            return [
                'message' => 'Product Created Successfully.',
                'status'  => '200',
                'result' => $result,
                'stock' => $stock,
                'estimateSales' => $retrievEstimateSales
            ];
        }
    }
    public function updateProduct(Request $request)
    {
        $message = '';
        $productData = $request->validate([
            'product_name' => 'required',
            'costs_till_ready_to_sell' => 'required',
            'payout_per_unit_by' => 'required',
            'ppc_cost_per_product' => 'required',
            'deposit_portion' => 'required',
            'deposit_leadtime' => 'required',
            'payment_delay_amazon' => 'required',
            'final_payment_portion' => 'required',
            'final_payment_leadtime' => 'required',
            'selling_price_for_sales_tax' => 'required',
            'id' => 'required',
        ]);
        if ($productData['deposit_leadtime'] < 0 || $productData['final_payment_leadtime'] < 0 || $productData['costs_till_ready_to_sell'] < 0 || $productData['payout_per_unit_by'] < 0 || $productData['deposit_portion'] < 0 || $productData['payment_delay_amazon'] < 0 || $productData['final_payment_portion'] < 0 || $productData['selling_price_for_sales_tax'] < 0 || $productData['ppc_cost_per_product'] < 0) {
            return [
                'message' => 'Negative Value Not Accepted',
                'status'  => '404',
            ];
            exit;
        }
        if ($productData['final_payment_leadtime'] > $productData['deposit_leadtime']) {
            return [
                'message' => 'Required | Deposite Lead-time Greater than Final Payment Lead-time',
                'status'  => '404',
            ];
            exit;
        }
        $productData['user_id'] = Auth::user()->id;
        $checkProductExist = Product::where('id', $productData['id'])->first();
        if ($checkProductExist['product_name'] == $productData['product_name']) {
            $productData['product_name'] = $checkProductExist['product_name'];
        } else {
            $checkProductNameExistOrNot = Product::searchProductName($productData['product_name']);
            if ($checkProductNameExistOrNot) {
                return [
                    'message' => 'Product name Already Exist',
                    'status'  => '404',
                ];
            }
        }
        Product::where('id', $productData['id'])
            ->where('user_id', $productData['user_id'])
            ->update($productData);
        return [
            'message' => 'Product Updated Successfully',
            'status'  => '200',
        ];
    }
    public function initialPaymentOFMonth(Request $request)
    {
        $requestedData = $request->validate([
            'current_year' => 'required',
            'current_month' => 'required',
            'product_id' => 'required',
            'initial_payment_date' => 'required',
            'initial_payment_amount' => 'required'
        ]);
        EstimateSales::where('entry_month',  $requestedData['current_month'])
            ->where('entry_year', $requestedData['current_year'])
            ->where('product_id', $requestedData['product_id'])
            ->where('user_id', Auth::user()->id)
            ->update([
                'initial_payment_date' => $requestedData['initial_payment_date'],
                'initial_payment_amount' => $requestedData['initial_payment_amount'],
                'initial_payment_paid' => true,
            ]);
        return [
            'message' => 'Initial Payement Paid Successfully.',
            'status'  => '200'
        ];
    }
    public function finalPaymentOFMonth(Request $request)
    {
        $requestedData = $request->validate([
            'current_year' => 'required',
            'current_month' => 'required',
            'product_id' => 'required',
            'final_payment_date' => 'required',
            'final_payment_amount' => 'required'
        ]);
        $checkInitalPaymentPaid = EstimateSales::where('entry_month', $requestedData['current_month'])
            ->where('entry_year', $requestedData['current_year'])
            ->where('product_id', $requestedData['product_id'])
            ->where('user_id', Auth::user()->id)
            ->where('initial_payment_paid', true)->first();
        if (!$checkInitalPaymentPaid) {
            return [
                'message' => 'Inital Payment Not Paid yet',
                'status'  => '404',
            ];
            exit;
        }
        $initalPaymentPaid = EstimateSales::where('entry_month',  $requestedData['current_month'])
            ->where('entry_year', $requestedData['current_year'])
            ->where('product_id', $requestedData['product_id'])
            ->where('user_id', Auth::user()->id)
            ->update([
                'final_payment_date' => $requestedData['final_payment_date'],
                'final_payment_amount' => $requestedData['final_payment_amount'],
                'final_payment_paid' => true,
            ]);
        return [
            'message' => 'Final Payement Paid Successfully.',
            'status'  => '200'
        ];
    }
    public function firstHalfMonthPayment(Request $request)
    {
        $requestedData = $request->validate([
            'current_year' => 'required',
            'current_month' => 'required',
            'product_id' => 'required',
            'fh_payment_date' => 'required',
            'fh_payment_amount' => 'required'
        ]);
        EstimateSales::where('entry_month',  $requestedData['current_month'])
            ->where('entry_year', $requestedData['current_year'])
            ->where('product_id', $requestedData['product_id'])
            ->where('user_id', Auth::user()->id)
            ->update([
                'fh_payment_date' => $requestedData['fh_payment_date'],
                'fh_payment_amount' => $requestedData['fh_payment_amount'],
                'fh_payment_paid' => true,
            ]);
        return [
            'message' => 'First Half Of The Month Debited Successfully.',
            'status'  => '200'
        ];
    }
    public function secondHalfMonthPayment(Request $request)
    {
        $requestedData = $request->validate([
            'current_year' => 'required',
            'current_month' => 'required',
            'product_id' => 'required',
            'sh_payment_date' => 'required',
            'sh_payment_amount' => 'required'
        ]);
        $initalPaymentPaid = EstimateSales::where('entry_month',  $requestedData['current_month'])
            ->where('entry_year', $requestedData['current_year'])
            ->where('product_id', $requestedData['product_id'])
            ->where('user_id', Auth::user()->id)
            ->update([
                'sh_payment_date' => $requestedData['sh_payment_date'],
                'sh_payment_amount' => $requestedData['sh_payment_amount'],
                'sh_payment_paid' => true,
            ]);
        return [
            'message' => 'Second Half Of The Month Debited Successfully.',
            'status'  => '200'
        ];
    }
}
