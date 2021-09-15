@extends('layouts.app')

@section('content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">{{ __('messages.site') }}: {{ $url->name}}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tr>
                    <td>ID</td>
                    <td>{{ $url->id }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.site_name') }}</td>
                    <td>{{ $url->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.created_at') }}</td>
                    <td>{{ $url->created_at }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.updated_at') }}</td>
                    <td>{{ $url->updated_at }}</td>
                </tr>
            </table>
        </div>

        <h2 class="mt-5 mb-3">{{ __('messages.checks') }}</h2>

        <form method="post" action="{{ route('urls.checks.store', $url->id) }}">
            @csrf
            <input type="submit" class="btn btn-primary" value="{{ __('messages.to_check') }}">
        </form>
        <br>
        @if(empty($checks))
            <h4 class="mt-5 mb-3">{{ __('messages.no_check') }}</h4>
        @else
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('messages.site_code') }}</th>
                        <th>h1</th>
                        <th>keywords</th>
                        <th>description</th>
                        <th>{{ __('messages.site_check') }}</th>
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
