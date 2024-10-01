@extends('layouts.main')
@section('content')
<style>
    .setimage {
        object-fit: cover;
    }
</style>
<h1>Resultados de la búsqueda</h1>

@if ($elevators->isEmpty() )
<p>No se encontraron resultados para su consulta.</p>
@else
@if (!$elevators->isEmpty())
<h2>Ascensores</h2>
<table class="table datatable">
    <thead>
        <tr>
            <th>ID</th>
            <th>FECHA ENTREGA</th>
            <th>TIPO DE ASCENSOR</th>
            <th>NOMBRE</th>
            <th>CLIENTE</th>
            <th>PROVINCIA</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($elevators as $item)
        <tr class="td-head-center">
            <td>{{ $item->id }}</td>
            <td>{{ $item->fecha }}</td>
            <td>@if ($item->tipoDeAscensor)
                {{ $item->tipoDeAscensor->nombre_de_tipo_de_ascensor }}
            @else
                {{ '-' }}
            @endif</td>
            <td>
                <a href="{{ route('view.elevator', $item->id) }}" class="text-blue">
                    {{ $item->nombre }}
                </a>
            </td>
            <td>
                @if ($item->client)
                <a href="{{ route('view.customer', $item->client_id) }}" class="text-blue">
                    {{ $item->client->nombre ?? '-' }}
                </a>
                @else
                {{ '-' }}
                @endif
            </td>


            <td>     @if ($item->province)
                {{ $item->province->provincia }}
            @else
                {{ '-' }}
            @endif</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endif
@endsection
