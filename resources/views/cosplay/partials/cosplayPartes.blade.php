@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        @can('createPart',$cosplay)
            <a href="{{ route('admin.cosplay.parts.create',$cosplay) }}" class="btn btn-primary">Nueva Parte</a>
        @endcan
    </div>
</div>

<div class="project-list">

    <table class="table table-hover">
        @foreach($cosplay->parts as $part)
            <tr>
                <td class="project-status">
                    <span class="label
                        @if($part->status == \App\Cosplay::PLANNED) label-default @endif
                        @if($part->status == \App\Cosplay::IN_PROGRESS) label-success @endif
                        @if($part->status == \App\Cosplay::FINISHED) label-primary @endif
                    ">{{  strtoupper($part->status) }}</span></dd>
                </td>
                <td class="project-title">
                    <a href="project_detail.html">{{ $part->name }}</a>
                    <br/>
                    <small>Creada {{ Carbon::parse($part->created_at)->format('d/m/Y') }}</small>
                </td>
                <td class="project-completion">
                    <small>Completado al: {{$part->progress}}%</small>
                    <div class="progress progress-mini">
                        <div style="width: {{$part->progress}}%;" class="progress-bar"></div>
                    </div>
                </td>
                <td class="project-actions">
                    @can('edit',$part)
                        <a href="{{ route('admin.cosplay.parts.edit',[$part->cosplay->id,$part->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>  </a>
                    @endcan
                    @can('delete',$part)
                        @include('helpers.confirm.index',[
                                                        'button' => [
                                                            'icon'=>'fa-trash-o',
                                                            'text'=>'',
                                                            'style'=>'danger btn-sm',
                                                        ],
                                                        'modal' => [
                                                            'confirm_text' => 'Borrar',
                                                            'confirm_style' =>'danger',
                                                            'callback' => '$("#deletePartForm'.$part->id.'").submit();',
                                                            'text' => 'Esta seguro que desea borrar la parte '.$part->name."?"
                                                        ]
                                                    ])
                        <form method="post" action="{{ route('admin.cosplay.parts.destroy',[$part->cosplay->id,$part->id]) }}" id="deletePartForm{{$part->id}}">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>