@extends('layouts.app')

@section('content')

<main class="flex-grow-1">
  <div class="jumbotron jumbotron-fluid bg-dark">
   <div class=container-lg>
     <div class="row">
        <div class="col-12 col-md-10 col-lg-8 text-white">
          <h1> {{ __('messages.name') }} </h1>
          <p> {{ __('messages.explanation') }} </p>
            <form action="{{ route('urls.store') }}" method="post" class="d-flex justify-content-center">
                @csrf
                <input type="text" name="url[name]" value="{{ old('url[name]') }}" class="form-control form-control-lg" placeholder="http://example.com">
                <button type="submit" class="btn btn-lg btn-primary ml-3 px-5 text-uppercase">{{ __('messages.check') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
