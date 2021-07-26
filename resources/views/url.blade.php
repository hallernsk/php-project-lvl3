@extends('layouts.app')

@section('content') 

<h2 class="mt-5 mb-3">Проверки</h2>

<form method="post" action="{{ route('urlChecks', $checks[2]->id) }}">
            @csrf
            <input type="submit" class="btn btn-primary" value="Запустить проверку">
            <input name="url_id" type="hidden" value="{{ $checks[2]->id }}">
</form>

<table class="table table-bordered table-hover text-nowrap">
            <tr>
                <th>ID</th>
                <th>Последняя проверка</th>
            </tr>
            @foreach ($checks as $check)
            <tr>
                <th>{{ $check->id }}</th>
                <th>{{ $check->updated_at }}</th>
            </tr>
            @endforeach
</table>

@endsection
