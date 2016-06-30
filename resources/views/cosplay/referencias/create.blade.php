@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nueva Referencia</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li>
                    <a href="{{ route('admin.cosplay.showtab',[$cosplay,'gastos']) }}">{{ $cosplay->name }}</a>
                </li>
                <li class="active">
                    <strong>Nueva Referencia</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('admin.cosplay.showtab',[$cosplay,'referencias']) }}" class="btn btn-danger">Volver</a>
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
                        <h5>Archivos</h5></span>
                    </div>

                    <form id="my-awesome-dropzone" method="post" class="dropzone" action="{{ route('admin.cosplay.referencias.store',$cosplay) }}">
                        {{ csrf_field() }}
                        <div class="dropzone-previews"></div>
                        <button type="submit" class="btn btn-primary pull-right">Subir Archivos</button>
                    </form>
                    <div>
                        <div class="m text-right"><small>Maximo de 20 archivos a la vez. Peso maximo 2 Mb</small> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')
    link href="{{ asset('/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('/js/plugins/dropzone/dropzone.js') }}"></script>
    <script>
        $(document).ready(function(){
            Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 20,
                maxFilesize: 2,
                acceptedFiles:'image/*',

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }

            }
        });

    </script>
@endsection