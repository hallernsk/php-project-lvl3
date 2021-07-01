@extends('layouts.app')

@section('content')
<div class="container">
    @include('flash::message')

    <p>Список адресов:</p>
    <table>
    @foreach ($urls as $url)
        <tr>
            <td><a href="/urls/{{$url->id}}">{{ $url->name }}</a></t>
        </tr>
    @endforeach
    </table>
</div>
@endsection
