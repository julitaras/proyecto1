<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
      <link rel="icon" type="image/x-icon" href="imagenes/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <title>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</title>
  </head>
  <body>
    <header>
      <div class="conteiner">
        <h1 class="imagen"><a href="/"><img src="imagenes/logo.jpg" alt="logo del sitio"></a></h1>
        <div class="titulo">
            <h2>Insta-Viaje</h2>
        </div>
        <div class="menu-usuario">
        <nav>
          <ul class="menu2">

              <li><a href="{{url('/logout')}}">Cerrar sesion </a></li>


        </ul>
        </nav>
        </div>

        </div>

        <div class="menu-principal">
        <nav >
          <ul class="menu">
            <li> <a href="/"> Home </a> </li>
            <li> <a href=""> Contacto </a> </li>
            <li> <a href="/faqs"> FaQs </a> </li>
            <form action="" class="lupa">
            <li>  <img src="./imagenes/lupa.png" width="20px" height="20px"> <input type="search" name="Buscador" class="buscar" value="buscar">  </li>
            </form>
        </ul>
        </nav>
      </div>

    </header>
    <br><br>
    <p>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</p>

<a href="{{url('/agregar')}}">Postea tu viaje!</a>
<br><br>
  <p>Tus posts!</p>
    <div class="">
      <ul>
        @foreach ($posts as $post)
        <a href="/post/{{$post->id}}"><li><p>Mi viaje a {{$post->lugar}}</p></li></a>
        @endforeach
      </ul>
    </div>
    {{-- <form action="/perfil" method="post">
    {{ csrf_field() }}
    {{ method_field('delete') }}
    <button type="submit">Borrar</button>

    <button type="button" formaction="/post/{{$post->id}}/edit"><a href="/post/{{$post->id}}/edit">Editar</button></a> --}}
    </div>
  </body>
</html>
