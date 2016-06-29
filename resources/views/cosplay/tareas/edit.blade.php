@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{$task->name}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li>
                    <a href="{{ route('admin.cosplay.showtab',[$cosplay,'tareas']) }}">{{ $cosplay->name }}</a>
                </li>
                <li class="active">
                    <strong>{{$task->name}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('admin.cosplay.showtab',[$cosplay,'tareas']) }}" class="btn btn-danger">Volver</a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <p>Por favor corrige los errores:</p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Informacion de la tarea</h5></span>
                    </div>

                    <form action="{{ route('admin.cosplay.tareas.update',[$cosplay,$task]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name',$task->name) }}">
                            </div>
                        </div>
                        <div class="ibox-footer text-right">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection