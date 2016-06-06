@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>{{ $cost->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li>
                    <a href="{{ route('admin.cosplay.showtab',[$cosplay,'gastos']) }}">{{ $cosplay->name }}</a>
                </li>
                <li class="active">
                    <strong>{{ $cost->name }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('admin.cosplay.showtab',[$cosplay,'gastos']) }}" class="btn btn-danger">Volver</a>
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
                        <h5>Informacion del gasto</h5></span>
                    </div>

                    <form action="{{ route('admin.cosplay.gastos.update',[$cosplay,$cost]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name',$cost->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal5" type="button">Agregar</button>
                                        <button class="btn btn-white" type="button">$</button>
                                    </span>
                                    <input type="number" class="form-control" step="0.01" id="cost" name="cost"  value="{{ old('cost',$cost->cost) }}">

                                </div>
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

    <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="input-group">
                        <label for="exampleInputEmail1">Cantidad a agregar</label>
                        <input type="number" id="cantidad" class="form-control" step="0.01" name="cost"  value="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="agregarCosto" data-dismiss="modal">Agregar</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('style')
@endsection

@section('scripts')
    <script>
            $(document).ready(function(){
               $('#agregarCosto').click(function(){
                   var cantidad = $('#cantidad');

                   if (cantidad.val() != ''){
                       $('#cost').val(parseFloat($('#cost').val()) + parseFloat(cantidad.val()));
                       cantidad.val('');
                   }
               });
            });
    </script>
@endsection