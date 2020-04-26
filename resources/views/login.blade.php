@extends('layout')
@section('title','Login')
@section('card-name','Seja bem-vindo')

@section('content')
<form action="login" method="post">
    <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email"
        placeholder="Qual o seu email?" maxlength="255" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input name="password" type="password" class="form-control" id="password"
      placeholder="Digite uma senha" maxlength="11" required>
    </div>
    <button type="submit" class="btn btn-success">Fazer login</button>
    {{@csrf_field()}}
</form>
@endsection
