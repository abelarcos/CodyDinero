@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <h2> Movimiento Nuevo</h2>

                        <form action="{{ route('movements.store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('movement_date') ? 'has-error' : '' }}">
                                <label >Fecha</label>
                                <input class="form-control" type="date" name="movement_date">
                                {!! $errors->first('movement_date', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                <label >Tipo</label>
                                <input  class="form-control" type="text" name="type" placeholder="Ejemplo  Egreso e Ingreso">
                                {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label >categoria</label>
                                <select  name ="category_id" class="form-control {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                    <option>Seleciona una categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id}}">{{ $category->name}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('category_id', '<span class="help-block">:message</span>')!!}
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label>Descripcion</label>
                                <textarea class="form-control" name="description" ></textarea>
                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                            </div>
                                
                            <div class="form-group {{ $errors->has('money') ? 'has-error' : ''  }}">
                                <label>Monto</label>
                                <input name="money" class="form-control" type="text" placeholder="0">
                                {!! $errors->first('money', '<span class="help-block">:message</span>')!!}
                        
                            </div>
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label>Imagen</label>
                                <input class="form-control" type="file" name="image">
                                {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                            </div>
                                
                            <button  type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

