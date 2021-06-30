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

<h2> Анализатор страниц </h2>
    <form action="{{ route('store') }}" method="post">
    @csrf
      <div>
        <label>
          Введите адрес сайта:    
          <input type="text" name="name" value="">
        </label>
      </div>
      <input type="submit" value="Проверить">
    </form>
@endsection
