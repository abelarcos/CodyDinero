@extends('layouts.app')


@section('content')

    <h1>{{ $title }}</h1>

    <table class="table table-bordered table-hover" >

        <thead>
            <tr>

                <th>Fecha</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th colspan="2" >Acciones</th>        


            </tr>
        </thead>
        <tbody>
            @foreach($movements as $movement)

                <tr>
                    <td>{{ $movement->movement_date->format('d/m/Y') }}</td>
                    <td>{{ $movement->type }}</td>
                    <td>{{ $movement->category->name}}</td>
                    <td>{{ number_format($movement->money, 2) }}</td>
                    <td>
                        <a href="{{ route('movements.show', $movement)}}">
                            Detalles
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('movements.edit', $movement)}}">
                            Editar
                        </a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

    <div class="text-center">
        @if(Request::get('type'))
            {!!$movements->appends('type', Request::get('type'))->links() !!}
        @else
            {!! $movements->links() !!}
        @endif

    </div>


@endsection