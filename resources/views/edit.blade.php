@extends('layout')
@section('title','Editar cliente')
@section('card-name','Editar cliente')

@section('content')
<form action="/edit" method="post">

    <input name="id" type="hidden" value="{{$dataUpdate->id}}">

    <div class="form-group">
      <label for="name">Nome</label>
      <input name="name" type="text" class="form-control" id="name"
      placeholder="Nome" maxlength="255" required
      value="{{$dataUpdate->name}}"
      >
    </div>

    <div class="form-group">
      <label for="phone">Telefone</label>
      <input name="phone" type="phone" class="form-control phone_with_ddd" id="phone"
      placeholder="(11)1234-5678" maxlength="13"
      required
      value="{{$dataUpdate->phone}}"
      >
    </div>

    <div class="form-group">
        <label for="adress">Endereço</label>
        <input name="adress" type="adress" class="form-control" id="adress"
        placeholder="Endereço" maxlength="255"
        required
        value="{{$dataUpdate->adress}}"
        >
    </div>

    <button type="submit" class="btn btn-success">Atualizar</button>
    {{@csrf_field()}}
</form>
@endsection
