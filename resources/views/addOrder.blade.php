@extends('layout')
@section('title','Adicionar pedido')
@section('card-name','Adicionar pedido')

@section('content')

<form action="add" method="post">
    <input name="id" type="hidden" value="{{$customerOrder}}">

    <div class="form-group">
        <label for="type">Tipo</label>
        <select name="type" class="form-control" id="type">
          <option>PIZZA TRADICIONAL</option>
          <option>PIZZA GOURMET</option>
          <option>PIZZA DOCE</option>
          <option>CALZONE</option>
          <option>TORTONES</option>
          <option>ROTOLINO</option>
        </select>
    </div>

    <div class="form-group">
        <label for="name">Descrição</label>
        <textarea name="description" class="form-control" id="description"
        placeholder="Digite a descrição do pedido..." maxlength="5000" required rows="5"></textarea>
    </div>
    <div class="form-group">
      <label for="value">Valor</label>
      <input name="value" type="text" class="form-control money" id="value"
      placeholder="0,00" maxlength="255" required>
    </div>
    <button type="submit" class="btn btn-outline-success">ADICIONAR PEDIDO</button>
    {{@csrf_field()}}
</form>
@endsection
