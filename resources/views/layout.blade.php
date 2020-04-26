<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <style>
        .background{
            background-color: #FBAB7E;
            background-image: linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

    </style>

    <title>La Ville | @yield('title','Home')</title>

</head>
<body class="background">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <img src="{{ url('images/bar.svg') }}" width="50" height="50" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        @if(Session::get('user'))
          <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-3">
              <a class="btn btn-outline-dark" href="/list">MEUS CLIENTES</a>
            </li>
            <br>
            <li class="nav-item active">
              <a class="btn btn-outline-dark" href="/add">ADICIONAR CLIENTE</a>
            </li>
          </ul>

            <div class="dropdown navbar-text">
                <button class="btn btn-outline-secondary dropdown-toggle"
                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> <b>{{Session::get('user')}}</b>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Editar perfil</a>
                  <a class="dropdown-item" href="logout">Sair</a>
                </div>
            </div>
        @endif

        @if(!Session::get('user'))
          <span class="navbar-item">
            <a class="btn btn-outline-dark mr-3" href="login">FAZER LOGIN</a>
          </span>
          <span class="navbar-item">
              <a class="btn btn-outline-dark" href="register">REGISTRAR</a>
          </span>
        @endif

        </div>
      </nav>
    </header>

    <main class="container">
        <div class="card mt-5">
            <div class="card-header">
            @yield('card-name')
            </div>

            <div class="card-body">
                @yield('content')
            </div>

        </div>
    </main>


    {{-- <footer class="footer font-small bg-light">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
           <b>La Ville | © 2020 Copyright</b>
        </div>
        <!-- Copyright -->
    </footer> --}}


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script type="text/javascript" src="<?php echo asset('js/jquery.mask.js')?>""></script>
<script type="text/javascript" src="<?php echo asset('js/masks.js')?>""></script>

</body>
</html>
