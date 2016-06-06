@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nuevo Gasto</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li>
                    <a href="{{ route('admin.cosplay.showtab',[$cosplay,'gastos']) }}">{{ $cosplay->name }}</a>
                </li>
                <li class="active">
                    <strong>Nuevo Gasto</strong>
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

                    <form action="{{ route('admin.cosplay.gastos.store',$cosplay) }}" method="post">
                        {{ csrf_field() }}
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" class="form-control" step="0.01" name="cost"  value="{{ old('cost') }}">
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
@endsection


@section('style')
    <link rel="stylesheet" href="{{asset('/css/plugins/nouslider/nouislider.min.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('/js/plugins/nouslider/nouislider.min.js') }}"></script>
    <script>


        var slider = document.getElementById('progreso');
        var slider1Value = document.getElementById('porcetaje');
        var slider1Value2 = document.getElementById('txtprogress');

        noUiSlider.create(slider, {
            start: {{ old('progress',0) }},
            step: 5,
            animate: false,
            range: {
                min: 0,
                max: 100
            }
        });

        slider.noUiSlider.on('update', function( values, handle ){
            slider1Value.innerHTML = values[handle] + " %";
            slider1Value2.value = values[handle];
        });



    </script>
@endsection