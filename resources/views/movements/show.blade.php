@extends('layouts.app')

@section('content')

    <h1>Detalles del Movimiento {{ $movement->id }}</h1>

    <table  class="table  table-bordered table-hover">
        <tr>
            <th>Tipo</th>
            <td>{{ $movement->type}}</td>
        </tr>
            
        <tr>
            <th>Fecha</th>
            <td>{{ $movement->movement_date->format('Y/M/d')}}</td>
        </tr>

        <tr>
            <th>Categoria</th>
            <td>{{ $movement->category->name}}</td>

        </tr>
        <tr>
            <th>Cantidad</th>
            <td>{{ number_format($movement->money_decimal, 2) }}</td>
        </tr>
        <tr>
            <th>Descripcion</th>
            <td>{{ $movement->description }}</td>
        </tr>
        <tr>
            <th>Imagen</th>
            <td>
                @if ($movement->image)
                    <a href="/storage/{{ $movement->image }} "  target="_blank">
                        <img src="/storage/{{ $movement->image }}" class="img-responsive" alt="Responsive image" style="max-width:500px;">
                    </a> 
                @endif 
            </td>
        </tr>

    </table>

@endsection