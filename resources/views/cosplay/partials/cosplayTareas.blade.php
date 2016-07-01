@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        @can('createCost',$cosplay)
            <a type="button" href="{{ route('admin.cosplay.tareas.create',$cosplay) }}" class="btn btn-primary">Nueva Tarea</a>
        @endcan
    </div>
</div>

<div class="col-lg-12">
        <ul class="todo-list m-t">
            @foreach(\App\Task::where('cosplay_id',$cosplay->id)->orderBy('status')->get() as $t)
                <li class="@if($t->status == \App\Task::STATUS_COMPLETED) bg-todo-completed @endif" id="task-{{ $t->id }}">
                    <div class="row">
                        <input type="hidden" id="taskUrl-{{ $t->id }}" value="{{route('admin.tareas.changeStatus',[$t,':status'])}}">
                        <div class="col-md-8">
                            <i class="fa fa-spinner fa-spin" style="display: none" id="spinner-{{ $t->id }}" aria-hidden="true"></i>
                            <div class="aaa" style="display: inline-block" id="checkdiv-{{ $t->id }}">
                            <input type="checkbox" value="" name="" class="i-checks checktareas" data-id="{{ $t->id }}" @if($t->status == \App\Task::STATUS_COMPLETED) checked @endif/>
                            </div>
                            <span class="m-l-xs @if($t->status == \App\Task::STATUS_COMPLETED) todo-completed @endif" id="tasktitle-{{ $t->id }}">{{ $t->name }}</span>
                        </div>
                        <div class="col-md-2">
                            @if($t->status == \App\Task::STATUS_COMPLETED)
                                <small class="label label-primary" id="taskdate-{{ $t->id }}">
                                    {{ Carbon::parse($t->updated_at)->format('d/m/Y') }}
                                </small>
                            @else
                                <small class="label label-primary" id="taskdate-{{ $t->id }}" style="display: none;">
                                    {{ Carbon::parse('now')->format('d/m/Y') }}
                                </small>
                            @endif
                        </div>
                        <div class="col-md-2 text-right">
                            @can('edit',$t)
                                <a href="{{ route('admin.cosplay.tareas.edit',[$cosplay,$t]) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                            @endcan
                            @can('delete',$t)
                                @include('helpers.confirm.index',[
                                                                    'button' => [
                                                                        'icon'=>'fa-trash-o',
                                                                        'text'=>'',
                                                                        'style'=>'danger btn-sm',
                                                                    ],
                                                                    'modal' => [
                                                                        'confirm_text' => 'Borrar',
                                                                        'confirm_style' =>'danger',
                                                                        'callback' => '$("#deleteTaskForm'.$t->id.'").submit();',
                                                                        'text' => 'Esta seguro que desea borrar la tarea '. $t->name .' ?'
                                                                    ]
                                                                ])
                                <form method="post" action="{{ route('admin.cosplay.tareas.destroy',[$t->cosplay->id,$t->id]) }}" id="deleteTaskForm{{$t->id}}">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                </form>
                            @endcan
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
</div>

