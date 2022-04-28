@extends('layout')
@section('title','Registrar')
@section('card-name','Se registre em nosso sistema')

@section('content')

@if(Session::get('status'))
<div class="alert alert-success" role="alert">
    {{Session::get('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<form action="register" method="post">
    <div class="form-group">
      <label for="name">Nome</label>
      <input name="name" type="text" class="form-control" id="name"
      placeholder="Qual o seu nome?" maxlength="255" required>
    </div>
    <div class="form-group">
        <label for="name">Email</label>
        <input name="email" type="email" class="form-control" id="name"
        placeholder="Qual o seu email?" maxlength="255" required>
      </div>
    <div class="form-group">
      <label for="phone">Password</label>
      <input name="password" type="password" class="form-control" id="phone"
      placeholder="Digite uma senha" maxlength="11" required>
    </div>
    <button type="submit" class="btn btn-success">Registrar</button>
    {{@csrf_field()}}
</form>
@endsection
