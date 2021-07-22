@extends('layouts.app')

@section('content') 
<h1 class="mt-5 mb-3">Сайт: {{ $url->name}}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <td>ID</td>
                    <td>{{ $url->id }}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{ $url->name }}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{ $url->created_at }}</td>
                </tr>
                <tr>
                    <td>Дата обновления</td>
                    <td>{{ $url->updated_at }}</td>
                </tr>
            </table>
        </div>
<h2 class="mt-5 mb-3">Проверки</h2>

<form method="post" action="{{ route('urlChecks', $url->id) }}">
            @csrf
            <input type="submit" class="btn btn-primary" value="Запустить проверку">
            <input name="urlid" type="hidden" value="{{ $url->id }}">
</form>

@endsection
