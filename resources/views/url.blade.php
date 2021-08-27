@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    @include('flash::message')
    <div class="container-lg">
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

        {{Form::open(['url' => route('url_checks.store', $url->id), 'method' => 'post'])}}
        {{Form::submit('Запустить проверку', ['class' => 'btn btn-primary'])}}
        {{Form::close()}}

<br>
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Код ответа</th>
                <th>h1</th>
                <th>keywords</th>
                <th>description</th>
                <th>Последняя проверка</th>
            </tr>
            @foreach ($checks as $check)
            <tr>
                <th>{{ $check->id }}</th>
                <th>{{ $check->status_code }}</th>
                <th>{{ $check->h1 }}</th>
                <th>{{ $check->keywords }}</th>
                <th>{{ $check->description }}</th>
                <th>{{ $check->updated_at }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</main>
@endsection
