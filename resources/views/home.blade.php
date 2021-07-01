@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="flex-grow-1">
  <div class="jumbotron jumbotron-fluid bg-dark">
   <div class=container-lg>
     <div class="row"> 
        <div class="col-12 col-md-10 col-lg-8 text-white">  
          <h1> Анализатор страниц </h1>
          <p> Бесплатно проверяйте сайты на SEO пригодность </p>
            <form action="{{ route('store') }}" method="post" class="d-flex justify-content-center">
    @csrf
            <input type="text" name="name" value class="form-control form-control-lg" placeholder="http://example.com">
            <input type="submit" class="btn btn-lg btn-primary ml-3 px-5 text-uppercase" value="Проверить">
          </form>
        </div>
      </div>  
    </div>
  </div>
</main>
<footer class="border-top py-3 mt-5 flex-shrink-0">
  <div class="container-lg">
      <div class="text-center">
        <a href="https://hexlet.io/pages/about" target="_blank">Hexlet</a>
      </div>
  </div>
</footer>
@endsection
