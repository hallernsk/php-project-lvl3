@extends('layouts.app')

@section('content')
<div class="container">
    @include('flash::message')

    <p>Список адресов:</p>

<table>
    <?php foreach ($urls as $url) : ?>
        <tr>
            <td>
                <?= $url->name ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>
</div>
@endsection
