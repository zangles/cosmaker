@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nueva Parte</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li>
                    <a href="{{ route('admin.cosplay.show',$cosplay) }}">{{ $cosplay->name }}</a>
                </li>
                <li class="active">
                    <strong>Nueva Parte</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('admin.cosplay.show',$cosplay) }}" class="btn btn-danger">Vovler</a>
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
                        <h5>Informacion de la parte</h5></span>
                    </div>

                    <form action="{{ route('admin.cosplay.parts.store',$cosplay) }}" method="post">
                        {{ csrf_field() }}
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estado</label>
                                <select name="status" class="form-control">
                                    <option value="{{ \App\CosplayPart::STATUS_PLANNED}}">{{ \App\CosplayPart::STATUS_PLANNED }}</option>
                                    <option value="{{ \App\CosplayPart::STATUS_IN_PROGRESS }}">{{ \App\CosplayPart::STATUS_IN_PROGRESS }}</option>
                                    <option value="{{ \App\CosplayPart::STATUS_FINISHED }}">{{ \App\CosplayPart::STATUS_FINISHED }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Progreso</label>
                                <div style="width: 100%;" id="progreso"></div>
                                <div class="text-center">
                                    <label style="margin-top: 10px" id="porcetaje" >{{ old('progress',0) }}%</label>
                                    <input type="hidden" name="progress" id="txtprogress" value="{{ old('progress',0) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Descripcion <small>(Opcional)</small></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
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