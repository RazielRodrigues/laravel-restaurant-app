<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Session;
use Crypt;

class CustomersController extends Controller
{

    function listCustomer()
    {
        $dataSelect = Customer::all();
        return view('list', ['data' => $dataSelect]);
    }

    function add(Request $req)
    {
        $dataInsert = new Customer;
        $dataInsert->name=$req->input('name');
        $dataInsert->phone=$req->input('phone');
        $dataInsert->adress=$req->input('adress');
        $dataInsert->save();
        $req->session()->flash('status','Cliente adicionado com sucesso!');
        return redirect('list');
    }

    function delete($id)
    {
        Customer::find($id)->delete();
        Session::flash('status','Cliente deletado com sucesso!');
        return redirect('list');
    }

    function edit($id)
    {
        $dataUpdate = Customer::find($id);
        return view('edit', ['dataUpdate' => $dataUpdate]);
    }

    function update(Request $req)
    {
        $dataUpdate = Customer::find($req->id);
        $dataUpdate->name=$req->input('name');
        $dataUpdate->phone=$req->input('phone');
        $dataUpdate->adress=$req->input('adress');
        $dataUpdate->save();
        $req->session()->flash('status','Cliente atualizado com sucesso!');
        return redirect('list');
    }

    function register(Request $req)
    {
        $dataInsertUser = new User;
        $dataInsertUser->name=$req->input('name');
        $dataInsertUser->email=$req->input('email');
        $dataInsertUser->password=Crypt::encrypt($req->input('password'));
        $dataInsertUser->save();
        $req->session()->put('user', $req->input('name'));
        // $req->session()->flash('status','Usuario registrado com sucesso!');
        return redirect('/');
    }

    function login(Request $req)
    {
        $user=User::where('email', $req->input('email'))->get();

        if (Crypt::decrypt($user[0]->password)==$req->input('password'))
        {

            $req->session()->put('user', $user[0]->name);
            return redirect('/');

        }

    }

    function logout()
    {

        session()->flush();

        return redirect('login');
    }

}
