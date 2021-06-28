@extends('layouts.app')

@section('content')
<h2> Анализатор страниц </h2>
    <form action="{{ route('store') }}" method="post">
    @csrf
      <div>
        <label>
          Введите адрес сайта:    
          <input type="url" name="name" value="">
        </label>
      </div>
      <input type="submit" value="Проверить">
    </form>
@endsection
