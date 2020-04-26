@extends('layout')
@section('title','Lista de pedidos')
@section('card-name','Lista de pedidos')

@section('content')

<div class="mb-4">
@foreach ($customerName as $item)
    @if ($loop->first)
        <b class="btn btn-success">{{$item->name}}</b>
        <a type="submit" class="btn btn-outline-success" href="../addOrder/{{$item->id}}">ADICIONAR PEDIDO</a>
        <input name="id" type="hidden" value="{{$item->id}}">
    @endif
@endforeach

</div>

<table class="table table-striped">
    <thead class="thead-striped">
        <tr>
          <th scope="col">Data</th>
          <th scope="col">Tipo</th>
          <th scope="col">Descrição</th>
          <th scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
@foreach ($data as $item)
      <tr>
        <td>{{$item->date}}</td>
        <td>{{$item->type}}</td>
        <td>{{$item->description}}</td>
        <td>{{$item->value}}</td>
    </tr>
@endforeach
    </tbody>
</table>
@endsection


