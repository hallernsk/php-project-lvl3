@extends('layouts.app')

@section('content')
<div class="container">
    @include('flash::message')

    <h1 class="mt-5 mb-3">Сайты</h1>
    <table class="table table-bordered table-hover text-nowrap">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Последняя проверка</th>
        </tr>
        @foreach ($urls as $url)
            <tr>
                <td>{{ $url->id }}</td>
                <td><a href="/urls/{{$url->id}}">{{ $url->name }}</a></td>
                <td>{{$lastCheck[$url->id]->created_at ?? ''}}</td>
            </tr>
        @endforeach

</div>
@endsection
