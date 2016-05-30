@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Cosplays</h2>
            <ol class="breadcrumb">
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('alerts.index')
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>listado de cosplays</h5></span>
                            <div class="text-right">
                                <a href="{{ route('admin.cosplay.create') }}" class="btn btn-primary">Nuevo Cosplay</a>
                            </div>

                        </div>

                        <div class="ibox-content">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Progreso</th>
                                        <th width="150px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cosplays as $c)
                                        <tr>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->status }}</td>
                                            <td>0%</td>
                                            <td>
                                                <button type="button" class="btn btn-success" title="Ver Cosplay">
                                                    <i class="fa fa-search" aria-hidden="true" ></i>
                                                </button>
                                                @include('helpers.confirm.index',[
                                                    'button' => [
                                                        'icon'=>'fa-trash-o',
                                                        'text'=>'',
                                                        'style'=>'danger',
                                                    ],
                                                    'modal' => [
                                                        'confirm_text' => 'Borrar',
                                                        'confirm_style' =>'danger',
                                                        'callback' => '$("#deleteForm'.$c->id.'").submit();',
                                                        'text' => 'Esta seguro que desea borrar el cosplay '.$c->name."?"
                                                    ]
                                                ])
                                                <form method="post" action="{{ route('admin.cosplay.destroy',[$c->id]) }}" id="deleteForm{{$c->id}}">
                                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- ibox -->
                </div> <!-- col -->
            </div> <!-- row -->
        </div><!-- content -->
    </div>

@endsection