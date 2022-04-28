@extends('layout')
@section('title','Listagem de clientes')
@section('card-name','Clientes cadastrados')

@section('content')

@if(Session::get('status'))
<div class="alert alert-success" role="alert">
    {{Session::get('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <table class="table table-striped">
        <thead class="thead-striped">
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Endereço</th>
            <th scope="col">Operações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
          <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->adress}}</td>
                <td>
                    <a class="btn btn-success mr-2" href="/addOrder/{{$item->id}}">
                        Novo
                    </a>
                    <a class="btn btn-outline-info" href="/orders/{{$item->id}}">
                        Pedidos
                    </a>
                    <a class="btn btn-outline-primary mr-2 ml-2" href="/edit/{{$item->id}}">
                        Editar
                    </a>
                    <a class="btn btn-outline-danger" href="/delete/{{$item->id}}">
                        Apagar
                    </a>
                </td>
          </tr>
        @endforeach
        </tbody>
      </table>
@endsection
