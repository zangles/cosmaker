@php
    use Carbon\Carbon;
    use App\User;

    if(!isset($tab)){
        $tab = 'gastos';
    }
@endphp
@extends('app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Detalle Cosplay</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.cosplay.index') }}">Cosplays</a>
                </li>
                <li class="active">
                    <strong>Detalle Cosplay</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('alerts.index')
        </div>
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        @include('cosplay.partials.cosplayInfo')
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li @if($tab=='partes') class="active" @endif><a href="#tab-1" data-toggle="tab">Partes</a></li>
                                                <li @if($tab=='gastos') class="active" @endif><a href="#tab-2" data-toggle="tab">Gastos</a></li>
                                                <li @if($tab=='tareas') class="active" @endif><a href="#tab-3" data-toggle="tab">Tareas</a></li>
                                                <li @if($tab=='referencias') class="active" @endif><a href="#tab-4" data-toggle="tab">Referencias</a></li>
                                                <li @if($tab=='progreso') class="active" @endif><a href="#tab-5" data-toggle="tab">Progreso</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1">
                                                @include('cosplay.partials.cosplayPartes')
                                            </div>
                                            <div class="tab-pane" id="tab-2">
                                                @include('cosplay.partials.cosplayCompras')
                                            </div>
                                            <div class="tab-pane" id="tab-3">
                                                @include('cosplay.partials.cosplayTareas')
                                            </div>
                                            <div class="tab-pane" id="tab-4">
                                                @include('cosplay.partials.cosplayReferencias')
                                            </div>
                                            <div class="tab-pane" id="tab-5">
                                                @include('cosplay.partials.cosplayProgreso')
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            @include('cosplay.partials.cosplayDescription')
        </div>
    </div>
@endsection