<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Page analyzer </title>
    <!-- CSS only (bootstrap !)-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="min-vh-100 d-flex flex-column">
    <header class="flex-shrink-0">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">Анализатор страниц</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">Главная</a>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="{{ route('urls.index') }}">Сайты</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @include('flash::message')
    @yield('content')
  </body>
</html>
