@extends('layout')
@section('title','Adicionar cliente')
@section('card-name','Adicionar cliente')

@section('content')
<form action="add" method="post">
    <div class="form-group">
      <label for="name">Nome</label>
      <input name="name" type="text" class="form-control" id="name"
      placeholder="Qual o nome?" maxlength="255" required>
    </div>
    <div class="form-group">
      <label for="phone">Telefone</label>
      <input name="phone" type="phone" class="form-control phone_with_ddd" id="phone"
      placeholder="(11)1234-5678" maxlength="255" required>
    </div>
    <div class="form-group">
        <label for="adress">Endereço</label>
        <input name="adress" type="adress" class="form-control" id="adress"
        placeholder="Qual o endereço?" maxlength="255" required>
    </div>
    <button type="submit" class="btn btn-success">Cadastrar</button>
    {{@csrf_field()}}
</form>
@endsection
