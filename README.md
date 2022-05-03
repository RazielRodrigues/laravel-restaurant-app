# Laravel 7 tutorial

Tutorial de como utilizar o Laravel 7 seguindo o vídeo do canal PHP STEP BY STEP:

https://www.youtube.com/watch?v=694SP68iy-o&list=PL8p2I9GklV46twRyl207h5LcsdjB9S9B0

	php artisan migrate:fresh
	php artisan migrate:install

	php artisan make:migration
	php artisan migrate

	php artisan optimize:clear
	composer dump-autoload
	composer clear-cache
	php artisan serve

	php artisan make:model Order -m

## 1. Instalação
    
    instalar composer: https://getcomposer.org/download/

    instalar o instalador do laravel pelo composer deixando assim mais rápido a criação de novos projetos pois armazena no cache do sistema.
		composer global require laravel/installer
		depois testar digitando no cmd "laravel"

    Para criar o projeto digite na pasta desejada
    	laravel new "nome do projeto"
    	Após isso entrar na pasta do projeto e digitar "php artisan serve" uma url aparecera no prompt
    	http://127.0.0.1:8000/

### Estrutura de diretorios

	Onde se escreve:	Html (dir views)
							- Quando se quer criar novas páginas
	                	Model (dir app)
	                		- Onde se meche com o banco de dados
	                	Controller (dir app)
	                		- Onde se cria os controladores da aplicação
	                	Routing (dir routes)
	                		- Onde se cria rotas de URL e rotas de api
	                	File store (dir storage)
	                		- Onde se guarda imagens de usuario etc
	                	Config
	                		- Configuração direto no core do laravel (sessão, conexão com o banco etc)pode ser alterado pelo arquivo .env também.
	                	Dependency File
	                		- Composer.json onde se carrega todas as dependencias do projeto para fazer,
	                		ele funcionar.

## Rotas (Routes)

O que são rotas?

Quando voce cria qualquer página no Laravel e deseja mostrar essa página.

Como fazer roteamento?

1. Primeiro se deve criar uma página do tipo blade em views.
2. Depois se deve abrir o arquivo web em routes, o arquivo web é onde se edita as rotas existem algumas forma de se escrever as rotas:

		//Escrevendo a rota da URL no primeiro parametro da função
		//e o nome da view que deseje que retorne.

		Route::get('/sample', function () {
		    return view('sample');
		});

		//Com o metodo get também conseguimos mandar e recuperar dados
		Route::get('/sample/{id}', function ($id) {
			echo $id;
		    return view('sample');
		});

		//Apenas com o metodo view, a rota fica mais customizada podendo ter um nome diferente no parametro da url
		Route::view('here','sample');

		//Para linkar com uma tag de ancora se deve cria uma tag <a> dessa forma
        //Assim ela bate na rota desejada

        <a href="here"> GO TO SAMPLE PAGE</a>

        //Para fazer redirects, basta trocar o metodo view por redirect

        Route::redirect('/','sample');

        ou

		Route::get('/', function () {
		    return redirect('sample');
		});

## Controladores (Controller)

O que são controladores?

É a parte do MVC que faz a conexão do Model com as Views, na Model é onde voce pega os dados e as Views são onde voce exibe os dados o controlador esta no meio dos dois.

Como criar controllers?

	No cmd digite

	php artisan make:controller Users

	*Controllers sempre devem ser no plural

Apos rodar o comando será criado um novo controller, essa é a estrutura basica de um controller

	<?php

	namespace App\Http\Controllers; // Diversas api uteis

	use Illuminate\Http\Request;

	class Users extends Controller
	{

		//Para criar os controller é necessário criar uma função que retorne algum dado.

		//Apenas com retorno
		function index()
		{
			return ['name'=>'Raziel M.'];
		}

		//Pegando dado da URL via GET e exibindo ele
	    function show($id)
	    {
	    	return "o seu id é = ".$id;
	    }

	}

Para que possa exibir os dados desse controller é necessário fazer uma rota com a seguinte estrutura

	Route::get('users','Users@index');
	Route::get('users2','Users@show');

Quando bater nessa rota irá exibir a informação do controller que ele retornou, é possível chamar mais de uma função do controller e também pegar parametros para isso basta adicionar o parametro entre chaves

	Route::get('users/{id}','Users@show');

### Visualização (Views)

O que são views?

Se trata da visualização do projeto feitas em HTML, CSS e JS.

Como fazer views?

Dentro da pasta views que está em resources, basta criar um arquivo blade.

Para exibir a pagina pelas rotas, parametro da url e nome da view

		Route::view('sample','sample');

Para exibir pelo controller

	function sample()
	{
		return view('sample');
	}

	//Dentro das rotas chamar o controller
	Routes::('sample','Users@sample');

Como passar dados do controller para a view?

	//Dentro do controller devemos criar um metodo que faça isso algo parecido com
	function sample()
	{
		return view('sample',['name'=>'Raziel M.']);
	}

	//E dentro da view devemos exibir a variavel, essa variavel tem escopo global, dessa forma irá exibir o nome 'Raziel M. vindo do controller'
	<h1>sample page {{$name}} </h1>

	//Se eu quiser também consigo modificar essa variavel passando o valor da variavel pela rota, basta adicionar um terceiro valor na função
	Route::view('sample','sample',['name'=>'igor']);

Chamando uma view que está em outro diretorio para isso usamos '.' no primeiro parametro para mostrar onde esta o arquivo ficando assim

	//Chamando uma view que esta em outro diretorio
	Route::view('nav.sample','sample',['name'=>'igor']);

### Visualização (Views - Components)

O que são componentes?

Códigos de front-end que podem ser reutilizados dentro do projeto, como menus, rodapé, caixas de busca etc

Como criar componentes?

	php artisan make:components Header

Após a criação do componente a primeira parte vai para a pasta "app/view/components" que é onde esta a classe do componente que é onde configuramos ele. Também temos uma página de html em branco que vai para a pasta "resources/views/components" onde fazemos o front-end

Como usar componentes?

1. Criar o componente
2. Criar a view onde deseja utilizar ele
3. Criar uma rota para a view
4. Dentro da view colocar a tag do componente ficando assim?

		<x-nomedocomponente />

Com  isso o componente já vai aparecer dentro da view.

Como passar dados para o componente? Dentro da tag dele deve adicionar um atributo, no caso será o title

	<x-header title="sample page"  />

Dentro da classe dele criar uma propriedade publica e depois passar o parametro para o construtor, assim sempre que for reutilizar em outra view pode-se alterar o valor de "title" que o valor ficara diferente independente da view que utilize, ficando assim no construtor:

	    public $title;
	    public function __construct($title)
	    {
	        $this->title=$title;        
	    }

E como passar o valor direto da rota? É a mesma lógica de como se tivesse exibindo direto a váriavel ficando assim no componente:

	<x-header title="sample page"  :name="igor"/>

no construtor:

	    public $title;
	    public $name;
	    public function __construct($title, $name)
	    {
	        $this->title=$title;
	       	$this->title=$name;           
	    }

nas rotas:

	Route::view('sample','sample',['name'=>'igor']);

Assim exibirá o dado que vem da rota na view do componente.

## Metodos HTTP e formulários

Os metodos HTTP são todos os tipos de requisição que temos na internet, POST vai junto com os cabeçalhos do header de requisições sendo apenas descriptografado no servidor, já GET é mandado diretamente pela URL como parametro de query e sendo visivél para o usuario. Dentro do laravel conseguimos ver informações do header usando alguns metodos como:

	echo $req->path(); //retorna o caminho da URL
	echo $req->method(); //retorna se é post ou get

Como criar formulários no laravel?

1. Se deve criar um formulário na view, nesse formulário a action dele deve ir para o controller que irá tratar dele, e definir o metodo dele (POST ou GET)

2. Na criação do controller deve ser um controller do tipo request, ficando algo assim dependendo do metodo que for utilizar e o que quer que aconteça com os dados vindos do seu form:

		function account(Request $req)
	    {

	    	// Pegando todos os input do formulario quando via post
	    	return $req->input();

	    	// Pegando todos os input do formulario quando via post e validando eles
	    	return $req->validate([
	    		'email' => 'required | min: 3 | max: 10',
	    		'password' => 'required | email'
	    	]);

	    	// Caso queira apenas um campo do formulario quando via post
	    	return $req->input('email');

	    	// Pegando dados do form quando via get
	    	return $req->query();

	    }   

3. Depois se deve criar uma rota de visualização desse formulário
4. Em seguida uma rota de envio de dados sendo algo assim:

		//Mandando via post, lembrando que a action do form tem que bater com o nome da rota daqui
		Route::post('userscontroller','UsersController@account');

		//Mandando via get, lembrando que a action do form tem que bater com o nome da rota daqui
		Route::get('userscontroller','UsersController@account');


5. Em seguida adicionar o csrf senão irá dar página expirada para isso dentro do form adicionar

			{{@csrf_field()}}


6. Metodos HTTP (HTTP Client "guzzlehttp") nova feature

Fazer requisições de API em json:

	//Usando o guzzlehttp para fazer requisições de API
	use Illuminate\Support\Facades\Http;

	$resp = Http::get('https://viacep.com.br/ws/17054050/json/');

	// Para enviar dados para a API
	$resp = Http::post('https://viacep.com.br/ws/17054050/json/', ['name'=>'raziel teste']);

	//Declara uma variavel com a resposta do metodo
	dd($resp->body());

7. Validação de formulários

Para validar usamos o metodo validate dentro da função de request, o metodo validate tem diversos parametro para ajudar a definiar o que queremos de fato validar, dentro da função de request escreva algo parecido com isso dependendo do que deseja:

		function account(Request $req)
	    {

	    	// Pegando todos os input do formulario quando via post e validando eles
	    	return $req->validate([
	    		'email' => 'required | min: 3 | max: 10',
	    		'password' => 'required | email'
	    	]);

	    } 

No HTML digite a variavel global:

	$errors->any();

Para validar em forma de lista:

	@if($errors->any())
	<div>
		<ul>
			@foreach($errors->all() as $err)
			<li>{{$err}}</li>
			@endforeach
		</ul>
	</div> 
	@endif

## Blade template

O que são blade template? São páginas providas pelo Laravel para poder escrever PHP, até se pode utilizar a sintaxe do php comum mas elas são substituidas por '@' e '{{}}'

	@ = usado para escrever condicionais de lógica, repeticação chamar metodos etc...

	{{}} = Usado para exibir variaveis

Como criar uma página blade?

1. Criar o arquivo em 'resources/views' nomedapagina.blade.php
2. Criar uma rota ou um controller que exiba essa view

		//via controller
		function index()
		{
			return view('nomedapagina');
		}

		Route::get('nomedapagina','nomeDoController@index');

		//via rota
		view('nomedapagina','nomedoparametrodeurl');

Como exibir variaveis em uma página blade?

1. Para exibir variaveis na pagina blade dentro do controller definir o que quer que seja exibido:

		function index()
		{
			$QueroExibir = ['name'=>'Raziel M.'];
			return view('nomedapagina','['name' => '$QueroExibir' ]');
		}

2. Dentro do blade chamar a variavel:

		{{$QueroExibir}}

Como fazer condicionais?

	@if($data['name'] == 'Raziel M.')
		<h1>To cansado</h1>
	@else
		<h2>mudou de pessoa</h2>
	@endif

Como fazer for each?

	@foreach ($data as $key => $item)
		<h3>{{$item}}</h3>
		<h2>{{$key}} : {{$item}}</h2>
	@endforeach

Como fazer for?

	@for($i=0; $i<10; $i++)
		<h1>o valor é : {{$i}}</h1>
	@endfor

Usando CSRF token e PUT:

		{{@csrf_field()}}
		@method('PUT');

Usando include:

		@include('welcome');

### Blade template layout

Reutilizar páginas de blade em outras páginas, com um layout padrão de CSS e etc assim como de JS também basicamente um blade template é voce definir todos os estilos dentro de uma determinada view e depois voce ir apenas trocando o miolo ou o "conteudo" , como fazer isso?

1. Criar a página de layout e as respectivas páginas que vão usar ela, uma página de layout fica assim:

		<!DOCTYPE html>
		<html>
		<head>

			//Variavel yield
			<title> @yield('title') - page</title>

		</head>
		<style type="text/css">
			.header{
				color: green;
			}

			.content{
				color: blue;
			}
		</style>
		<body>
			<div class="header">
				
				//Nome da sessão que depois é chamada na página que vai usar
				@section('header')
				<h1>header is common</h1>
				@show

			</div>

			<div class="content">

				//Nome da sessão que depois é chamada na página que vai usar
				@section('content')

				@show //Metodo para mostrar na outra página
			</div>

		</body>
		</html>


2. Criar as devidas rotas para as views que vão utilizar o template

3. Para estender a página de layout em outras se usa o metodo @extends, basta colocar na view que deseja que receba o conteudo da página de layout

		@extends('layout')

4. Para definir o valor do campo @yield se usa:

		@section('title','Home') //1 parametro Nome da variavel do yield, 2 parametro valor 

5. Para usar o 'layout' mas apenas mudar o conteúdo dele se usa:

		@section('content')
			"Aqui dentro vai o conteúdo que deseja"
		@endsection

6. Para usar o 'layout' e alterar um conteudo que já existe dentro do 'layout' se usa:

		@section('header')

			@parent // Exibe o header common original

			Dessa forma altera o "header common"
		
		@endsection

## Middleware

O que são middleware?

O Middleware é apenas um mecanismo de filtragem de requisição HTTP. Ou seja, ele permite ou barra determinados fluxos de requisição que entram na sua aplicação, baseado em regras definidas.

Como criar um middleware?

1. php artisan make:middleware "nomeDoMiddleware"

Após criado se encontra em app/http/middleware

Existem tres grupos de middleware são eles:

Global = Fica registrado dentro do grupo global no kernel, e aplica direto no fluxo de requisição de qualquer parte do sistema de qualquer requisição.

		protected $middleware = [

	    	//Registrar middleware global
        	\App\Http\Middleware\CheckAge::class,

	    ];

Group = Fica registrado um grupo de middleware sendo possível depois "agrupar" diversas rotas dentro do metodo deles e fazendo cada rota passar por mais de um middleware.

	    protected $middlewareGroups = [

		    //Registrar middleware em grupo
	        'customAuth' => [
	             \App\Http\Middleware\CheckAge::class,
	        ]

	    ];

Routes = Fica registrado junto do grupo de middlewares de rotas, depois sendo possivel ser chamado via metodo por uma rota especifica ou uma chamada por vez, diferente do grupo que engloba diversas dentro dele.

	    protected $routeMiddleware = [

	    		//Registrar middleware em rotas
	            'customRouteAuth' => \App\Http\Middleware\CheckAge::class,

	    ];

2. Registrar ele no arquivo Kernel.php dependendo do qual tipo de middleware que quer

3. Criar a lógica do seu middleware no respectivo arquivo dele um exemplo de lógica que pega o parametro age via get e libera as páginas somente se a pessoa ter mais de 20 anos, do contrário faz um redirect para uma página de sem acesso, dentro da classe do middleware se encontra o metodo de requisição é dentro dele que escrevemos as condicionais:

	    public function handle($request, Closure $next)
	    {
	        if ($request->age && $request->age<20)
	        {
	            return redirect('noaccess');
	        }
	        return $next($request);
	    }

4. Depois disso tudo se resume nas rotas e dependendo de qual tipo de middleware voce usou cada um vai ter uma implementação diferente

Middleware global:

Como dito anteriormente pega globalmente não sendo necessário registrar nenhuma rota mas para testar use

	http://127.0.0.1:8000/?age=12

Deve jogar direto para a página de redirect

Middleware em grupo:

	//Aqui chamamos a rota do grupo de middleware
	Route::group(['middleware' => ['customAuth']], function(){

		//Essa é a view que será liberada caso retorne true na lógica do middleware
	 	Route::get('/', function () {
	 	    return view('welcome');

	 	//Como estamos trabalhando com um grupo, podemos adicionar mais uma rota que nela também
	 	será aplicado o middleware
	 	Route::view('profile','profile');

	});

Middleware em rotas:

	//Assim aplicamos o middleware direto na rota
	Route::view('profile','profile')->middleware('customRouteAuth');


Middleware CSRF Token:

Ir até a pasta middleware, e no arquivo "VerifyCsrfToken.php" fazer da seguinte forma:

    protected $except = [
        '*';
    ];

Assim vai liberar CSRF para todas as URL de formulário ou pode-se usar o @csrf no form direto.

## Fazer requisições de API

Com o Laravel conseguimos fazer requisições API usando o metodo Http do pacote guzzle, lembrando que se for utilizar localhost com o wamp pode dar esse problema:

https://stackoverflow.com/questions/29822686/curl-error-60-ssl-certificate-unable-to-get-local-issuer-certificate

Como fazer 'fetch' ou consumir uma API?

1. Fazer o controller que deve ser algo como:

Lembrando que antes de construir o controller tem que adicionar o pacote

		use Illuminate\Support\Facades\Http;


Bem dito isso o controller fica assim

		function list()
		{
			return Http::get('https://jsonplaceholder.typicode.com/posts')->body();
		}

Com isso já conseguimos acessar a API em formato JSON mas tudo bagunçado e fora de um array.

2. Criar uma rota para o controller do tipo get.

3. Melhorar a visualização da API

Para isso vamos trocar o  metodo no controller de body() para json() dessa forma salva a API dentro de um array sendo mais fácil para manipular 

		function list()
		{
			return Http::get('https://jsonplaceholder.typicode.com/posts')->json();
		}

após trocar o metodo para json devemos retornar os dados para a view que desejamos, ficando algo como:

		function list()
		{
			$data = return Http::get('https://jsonplaceholder.typicode.com/posts')->json();

			return view('profile',['data'=>$data])
		}

A view deve retornar limpa e não mais "suja" de json, para acessar os dados na view podemos usar print_t para testar, pois mesmo assim fica "suja":

		{{print_r($data)}}

Para fazer de uma forma mais bonita fazemos, com for each assim podemos selecionar o que queremos que seja exibido

		<ul>
		@foreach($data as $item)

		<li>{{$item['title']}}</li>

		@endforeach
		</ul>

## Sessões

O que são sessões?

Sessões em PHP são variaveis a nivel super global que voce consegue armazenar informações de usuario dentro dela de forma que também possam ser acessada de qualquer parte do codigo.

Como trabalhar com sessões dentro do Laravel?

1. Fazer uma view com formulário

2. Fazer uma rota para essa view

3. Fazer um controller, e salvar os dados na sessão:

		function index(Request $req)
		{
			//Salvando os dados da sessão na variavel $req que vieram dos inputs da página
			//e salvando na chave sessionData, depois retorna para a pagina profile

			$req->session()->put('sessionData', $req->input());
			return redirect('profile');
		}

Para exibir os dados na view profile usamos:

		<h1>{{session('sessionData')['user']}}</h1>
		<h1>{{session('sessionData')['password']}}</h1>

4. Fazer a funcionalidade de logout:

		Route::get('profile/','Profiles@list', function(){
			if (!session()->has('sessionData')) {
				return redirect('login');
			}
			return view('profile');
		});

		Route::get('/logout', function(){
			session()->forget('sessionData');
			return redirect('login');
		});

Na view:

		<a href="logout">sair</a>

### Sessões com middleware

Como fazer?

1. Criar o middleware

2. Passar a lógica de login pra ele

3. Ajustar ele na rota ficando mais ou menos assim

		Route::view('login','login');
		Route::post('login','Login@index');
		Route::get('/logout', function(){
			session()->forget('sessionData');
			return redirect('login');
		});

		//Tudo que tiver aqui dentro so pode ser acesssado
		se tiver feito login
		Route::group(['middleware' => ['customAuth']], function(){
			Route::view('profile','profile');
			Route::get('profile','Profiles@list');
			Route::get('/', function () {
			    return view('welcome');
			});
		});

### Sessões flash

O que são?

Tem o mesmo conceito das outras a diferença é que funciona apenas uma vez.

Como fazer?

1. Criar um form

2. Criar uma rota para essa view

3. Criar um controller para essa sessão, ficando algo como:

		function index(Request $req)
		{
			$req->session()->flash('status', 'deu certo!');
			return redirect('task');
		}

4. Chamar o controller via post

5. exibir a sessão na view algo como

		<h1>{{session('status')}}</h1>

O que vai acontecer basicamente é que invez da sessão continuar ali, na verdade ela vai sumir quando der refresh

como uma mensagem de aviso que deu certo!

### Localização

É quando voce consegue mudar a localidade da sua aplicação, em questão de pais, como esta rodando no brasil e depois na india.

Como fazer?

1. criar uma view

2. criar um arquivo com o nome da lingua dentro do diretorio resources/lang e colocar o nome do diretorio da lingua que quer

3. escrever assim dentro do arquivo da lingua ficando assim

		<?php 
		return [
			'welcome' => 'welcome to profile page',
			'home' => 'Home',
			'settings' => 'Settings'
		]
		?>

4. Para exibir na view usamos

		<h1>{{__('profile.welcome')}}</h1>

Na view aparecerá "welcome to profile page"

5. Dentro do diretorio config temos o arquivo app e temos as linhas

		// Essa linha define o diretorio e lingua default do sistema
	    'locale' => 'en',

	    // Essa linha define qual é a lingua se o parametro que o usuario
	    passar na url nao existir
	    'fallback_locale' => 'en',

6. Pegar o parametro pela url assim o usuario pode escolher a lingua

		 Route::get('/profile/{lang}', function ($lang) {
		 	 App::setlocale($lang);
		     return view('profile');
		 });

## Upload de arquivos

1. Fazer um form com do tipo upload ficando como:

		<form action="task" method="post"
		enctype="multipart/form-data">
			<input type="file" name="img">
			<button type="submit">enviar</button>
				{{@csrf_field()}}
		</form>

2. Criar um controller do tipo upload ficando algo como:

		function store(Request $req)
		{
			$path = $req->file('img')->store('avatars');
			return ['path' => $path, 'upload' => 'success'];
		}

3. Fazer uma rota pro controller

		Route::post('task','Profiles@store');

4. após o post será exibido o path onde a imagem foi guardada que no caso se encontra em storage/app/avatars

## Banco de dados: conexão

1. Configurar o arquivo .env (arquivo de configuração de ambiente) nessa parte

		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=youtube
		DB_USERNAME=root
		DB_PASSWORD=

2. Criar o controller para o select de teste algo como

		function db()
		{
			return DB::select('select * from user1');
		}

E também colocar o pacote

use Illuminate\Support\Facades\DB;

3. Criar em seguida a rota.

Deverá ser exibido o que existe nessa tabela em formato json

## Banco de dados: Montador de query

É uma função provida pelo Laravel para te ajudar

Como pegar dados?

1. Estar com o DB configurado

2. Cria um controller, e adicionar a classe do db

3. Uma rota para ele com get e no controller, assim se repete com todas as operações ficando algo como:

        <?php

        namespace App\Http\Controllers;
        use Illuminate\Support\Facades\DB;
        use Illuminate\Http\Request;

        class Database extends Controller
        {
         function select()
         {
          //Select simples todos os dados
          //return DB::select('select * from user1');

          //Select em uma table  traz todos os dados
          // return DB::table('user1')->get();

          //Select com where
          // return DB::table('user1')
          // ->where('nome','raziel miranda')
          // ->get();

          //Contagem de registros na tabela
          // $data = DB::table('user1')->count();

          //Primeiro registro
          // $data = DB::table('user1')->first();

          //Procura o id pelo número dentro do metodo
          // $data = DB::table('user1')->find(2);
          //print r para ver os resultados
          // print_r($data);
         }

         function delete()
         {
          //delete simples, sem o where apaga tudo
          // $data = DB::table('user1')
          // ->where('nome','raziel miranda')
          // ->delete();
           //print_r($data);
         }

         function insert()
         {
           $insertRandom = time();
           $data = DB::table('user1')
           ->insert(
            [
             'nome'=> $insertRandom,
            ]
           );

           print_r($data);
         }

         //function update()
         //{
           // $data = DB::table('user1')
           // ->where('id',2)
           // ->update(
           //  [
           //   'nome'=> 'alterado pelo denvo!',
           //  ]
           // print_r($data);
                 // );
         //}

        }

         Route::get('home','Database@select');
         Route::get('home','Database@delete');
         Route::get('home','Database@insert');
         // Route::get('home','Database@update');

## Banco de dados: Joins

         function selectJoin()
         {
          $data = DB::table('user1')
          ->select('user1.nome','produtos.quantidade')
          ->join('produtos','user1.id','produtos.id_user')
          //->leftjoin('produtos','user1.id','produtos.id_user')
          //->rightjoin('produtos','user1.id','produtos.id_user')
          ->where('nome','igor pereira')
          ->get();
          echo "<pre>";
          print_r($data);
         }

## Banco de dados: Listando na view

no controller do banco

         function selectView()
         {
          $data = DB::select('select * from user1');
          return view('home', ['data' => $data]);
         }

chama na rota e na view exibe

         @foreach($data as $item)
         <li>{{$item->nome}}</li>
         @endforeach

## Banco de dados: Listando na view com paginação

         function selectView()
         {
          $data = DB::table('user1')->paginate(2);
          return view('home', ['data' => $data]);
         }

na view

         {{$data->links()}}

## Banco de dados: Models

O que é models?

Models são as regras de negocio do banco de dados, v

Como fazer models?

      php artisan make:model Produtos

vai para o diretorio app/

Como usar models?

no controller colocar o seguinte comando

      return Produto::all();

O nome da model tem que ser sempre no singular, e o do banco plural

      model: Produto
      table: produtos

Se caso for outro nome a table pode colocar uma variavel com o nome correto
essa variavel vai direto na model, por exemplo:

     protected $table = 'user1';

## Banco de dados: Metodos

         function selectView()
         {
          //Retorna todos os dados
          //return Produto::all();

          //Retorna com where
          //return Produto::where('id', 5)->get();

          //Retorna o campo id 6
          //return Produto::find(6);

          //Retorna metodos de contagem
          //return Produto::max('id');
          //return Produto::min('id');
          //return Produto::sum('id');
          //return Produto::avg('id');

         }

## Banco de dados: Insert pela view

1.

Criar a view com o formularío

2.

Retornar a view

3.

Criar o controller e a chamada dele

4.

Fazer o model e chamar o model dentro do controle e importar o database também

5.

Escrever o código do insert

        function save(Request $req)
        {

             // print_r($req->input());
             $produto = new Produto;
             $produto->quantidade = $req->quantidade;
             $produto->nome_produto = $req->nome;
             $produto->id_user = $req->id_user;

             echo $produto->save();
        }

## Banco de dados: Update pela view

Mesmo processo só muda o código

        function update(Request $req)
        {

            echo Produto::where('id', $req->iduser)
            ->update(['nome_produto' => $req->nomeuser]);

            //Outra forma de fazer update
            $update = Produto::find($req->id);
            $update->nome_produto=$req->nomeuser;
            $update->save();
        }

## Banco de dados: Deletando pela view

Mesmo processo só muda o código

       function delete(Request $req)
        {
            $delete = Produto::find($req->iduser);
            echo $delete->delete();

            Assim se deleta um array todo
            Produtos::destroy(1,4);
        }

## Banco de dados: Seeding de dados

O que é seeding ou semeamento de dados?

Vamos supor que voce tem uma database de produção e quer copiar os dados para uma de desenvolvimento
é para isso que funciona o semeamento de dados.

Como fazer seeding?

Ir até o caminho database/seeding dentro do arquivo

colocar o metodo que voce deseja que execute, no caso um insert observe

        public function run()
        {
            // $this->call(UserSeeder::class);

            DB::table('produtos')->insert([
                'nome_produto' => 'teste sobre seeder',
                'id_user' => '2',
                'quantidade' => 20,
            ]);
        }

em seguida rodar o comando

        php artisan db:seed

Tudo que colocou lá no seeder vai ser adicionado no banco de dados

e como criar um novo arquivo de seeder?

        php artisan make:seeder nome_do_arquivo

Para aparecer é importante rodar o
  
        composer dump-autoload

E ai o seed do novo arquivo está pronto para se usar, para chamar o seeder de um arquivo
diferente se usa

        php artisan db:seed --class=NomeDoArquivo de seed

Assim vai rodar o seed do outro arquivo

## Banco de dados: Accessors

O que são acessors?

Quando você quer que os dados ja venham formatados pra voce a partir da model ou seja
fica cuidando e fazendo modificações nos dados direto na model.

Como criar acessores?

1. Criar o controller

2. Criar a model

3. Criar as rotas

4. Dentro da model:

            //Faz a primeira letra dos valores do campo ficarem maior
              public function getNomeProdutoAttribute($value)
            {
                return ucfirst($value);
            }

            //Diminui todas as quantidas com menos 10
            public function getQuantidadeAttribute($value)
            {
                return $value=($value - 10);
            }

## Banco de dados: Mutators

O que são modificadores?

Quando voce quer salvar um dado no banco de dados mas modificado antes de entrar nele.

Como fazer Mutators?

1. Criar o controller

2. Criar a model

3. Criar as rotas

4. No controller seria como um insert

4. Dentro da model:

            public function setNomeProdutoAttribute($value)
            {
                return $this->attributes['nome_produto']=ucfirst($value);
            }

Assim todos os salvos que forem ser salvos no banco de dados irão
ter a primeira letra capitalizada.

## Banco de dados: Relação 1 para 1

Como fazer relações 1 para 1 no Laravel?

As tabelas devem ter as relações já embutida nelas, exemplo de como fazer:

1. Já ter o controller e a rota pronta

2. Criar as models para as respectivas tabelas

Exemplo tabelas: 

Users (1) para (1) Companies

Na tabela Companies vai uma FK de users

3. No model da Users

        function myCompany()
        { 
            //Retorna se existe um registro na tabela companies onde:
            //O primeiro parametro é o nome do campo FK na outra tabela
            //O segundo parametro é o nome do campo na propria tabela
            //return $this->hasOne('App\Companies','id_users','id');

            //Assim ele só verifica direto se existe algum id de users em companies
            return $this->hasOne('App\Companies');
        }

4. No controller

        //Esse metodo find serve para buscar um número de ID na tabela   
        function find()
        {
          //Pesquisa na tabela Companies se tem o número de ID 2
          //referente a FK da tabela Users
          return Users::find(2)->myCompany;
        }

## Banco de dados: Relação 1 para N

Mesma coisa que 1 para 1 somente muda o metodo do model que passa a ser:

        return $this->hasMany('App\Companies','id_users','id');

Fim dos estudos básicos de Laravel.
