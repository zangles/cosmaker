@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="m-b-md">
            <a href="#" class="btn btn-white btn-xs pull-right">Editar Cosplay</a>
            <h2>Cosplay: {{ $cosplay->name }}</h2>
        </div>
        <dl class="dl-horizontal">
            <dt>Estado:</dt> <dd><span class="label
                @if($cosplay->status == \App\Cosplay::PLANNED) label-default @endif
                @if($cosplay->status == \App\Cosplay::IN_PROGRESS) label-success @endif
                @if($cosplay->status == \App\Cosplay::FINISHED) label-primary @endif
                        ">{{  strtoupper($cosplay->status) }}</span></dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <dl class="dl-horizontal">
            <dt>Creado por:</dt> <dd>{{ User::find($cosplay->owner)->cosplayer_name }}</dd>
            <dt>Presupuesto:</dt> <dd>{{ ($cosplay->budget > 0)?"$ ".$cosplay->budget:"Sin presupuesto" }}</dd>
            <dt>Gastado:</dt> <dd>$ 0</dd>
            @if($cosplay->budget > 0)
                <dt>Disponible:</dt> <dd>$ {{ $cosplay->budget }}</dd>
            @endif
        </dl>
    </div>
    <div class="col-lg-7" id="cluster_info">
        <dl class="dl-horizontal" >

            <dt>Fecha creacion:</dt> <dd>{{ Carbon::parse($cosplay->created_at)->format('d/m/Y') }}</dd>
            <dt>Participantes:</dt>
            <dd class="project-people">
                @foreach($cosplay->users()->get() as $user)
                    <a href="#"><img alt="image" class="img-circle" src="{{ asset('/img/profile.png') }}" title="{{$user->cosplayer_name}}"></a>
                @endforeach
            </dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <dl class="dl-horizontal">
            <dt>Completado:</dt>
            <dd>
                <div class="progress progress-striped active m-b-sm">
                    <div style="width: {{ $cosplay->getProgress() }}%;" class="progress-bar progress-bar-success"></div>
                </div>
                <small>Cosplay completado al <strong>{{ $cosplay->getProgress() }}%</strong>.</small>
            </dd>
        </dl>
    </div>
</div>