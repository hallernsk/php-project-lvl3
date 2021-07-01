@extends('layouts.app')

@section('content') 
<h2> Адрес: </h2>
<table>
        <tr>
            <td>{{ $url->id }}</td>     
            <td>{{ $url->name }}</td>
            <td>{{ $url->updated_at }}</td>
        </tr>
</table>
@endsection
