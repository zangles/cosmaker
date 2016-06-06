@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Editar cosplay</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('admin.cosplay.show',$cosplay) }}" class="btn btn-danger">Volver</a>
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
                        <h5>Informacion del cosplay</h5></span>
                    </div>

                    <form action="{{ route('admin.cosplay.update',$cosplay) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name',$cosplay->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estado</label>
                                <select name="status" class="form-control">
                                    <option @if($cosplay->status == \App\Cosplay::PLANNED ) selected @endif value="{{ \App\Cosplay::PLANNED }}">{{ \App\Cosplay::PLANNED }}</option>
                                    <option @if($cosplay->status == \App\Cosplay::IN_PROGRESS ) selected @endif value="{{ \App\Cosplay::IN_PROGRESS }}">{{ \App\Cosplay::IN_PROGRESS }}</option>
                                    <option @if($cosplay->status == \App\Cosplay::FINISHED ) selected @endif value="{{ \App\Cosplay::FINISHED }}">{{ \App\Cosplay::FINISHED }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Presupuesto <small>(Opcional)</small></label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="budget" value="{{ old('budget',$cosplay->budget) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Descripcion <small>(Opcional)</small></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">{{ old('description',$cosplay->description) }}</textarea>
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