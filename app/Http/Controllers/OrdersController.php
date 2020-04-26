<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Session;
use DB;


class OrdersController extends Controller
{

    function listOrder(Request $req)
    {
        $dataSelect = Customer::find($req->id)->myOrders;

        $dataSelectName = DB::table('customers')
        ->select('customers.id','customers.name')
        ->join('orders','customers.id','orders.customers_id')
        ->where('customers_id',$req->id)
        ->get();

        return view('orders',['data' => $dataSelect, 'customerName' => $dataSelectName]);
    }

    function makeOrder(Request $req)
    {
        $dataInsertOrder = $req->id;
        return view('addOrder', ['customerOrder' => $dataInsertOrder]);
    }

}
