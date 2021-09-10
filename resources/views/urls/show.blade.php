@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
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

        <form method="post" action="{{ route('urls.checks.store', $url->id) }}">
            @csrf
            <input type="submit" class="btn btn-primary" value="Запустить проверку">
        </form>
 <br>
    @if(empty($checks))
      <h4 class="mt-5 mb-3">Проверок еще не было</h4>
    @else
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
                <th>{{ Str::limit($check->h1, 30) }}</th>
                <th>{{ Str::limit($check->keywords, 50) }}</th>
                <th>{{ Str::limit($check->description, 50) }}</th>
                <th>{{ $check->updated_at }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
  </div>
</main>
@endsection
