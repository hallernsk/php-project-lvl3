@extends('layouts.app')

@section('content') 
<h2> Вы ввели адрес: </h2>
<table>
        <tr>
            <td>
                <?= $url->name ?>
            </td>
        </tr>
</table>
@endsection
