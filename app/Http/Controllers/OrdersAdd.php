<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Date;

class OrdersAdd extends Controller
{
    function addOrder(Request $req)
    {

        $dataInsert = new Order;
        $dataInsert->customers_id=$req->input('id');
        $dataInsert->type=$req->input('type');
        $dataInsert->description=$req->input('description');
        $dataInsert->value=$req->input('value');
        $dataInsert->date=date('d/m/Y H:i:s');
        $dataInsert->save();
        $req->session()->flash('status','Pedido adicionado com sucesso!');
        return redirect('list');
    }
}
