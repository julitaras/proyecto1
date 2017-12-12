<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <title>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</title>
  </head>
  <body>
    <header>
        <h1><a href="/"><img src="imagenes/logo.jpg" alt="logo del sitio"></a></h1>
        <div class="titulo">
            <h2>Insta-Viaje</h2>
        </div>
    </header>
    <p>{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</p>

<a href="{{url('/agregar')}}">Postea tu viaje!</a>
<br><br>
  <p>Tus posts!</p>
    <div class="">
      <ul>
        @foreach ($posts as $post)
        <a href="{{url('/posts')}}"><li><p>Mi viaje a {{$post->lugar}}</p></li></a>
        <li>Viaje en {{$post->transporte}}</li>
        <li>{{$post->duracion}}</li>

        @endforeach

      </ul>

  </form>
    </div>
  </div>
  </body>
</html>