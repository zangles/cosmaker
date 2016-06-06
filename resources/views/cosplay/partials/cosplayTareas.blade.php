@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        @can('createCost',$cosplay)
            <a type="button" href="{{ route('admin.cosplay.gastos.create',$cosplay) }}" class="btn btn-primary">Nueva Tarea</a>
        @endcan
    </div>
</div>

<div class="col-lg-12">
        <ul class="todo-list m-t">
            <li class="bg-todo-completed">
                <div class="row">
                    <div class="col-md-8">
                        <input type="checkbox" value="" name="" class="i-checks"/>
                        <span class="m-l-xs" >
                            <span class="m-l-xs todo-completed">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi, corporis dignissimos ea harum inventore, ipsa, labore maiores minus nulla odio quaerat quam quasi qui sint voluptatum? Consequuntur delectus molestiae saepe.
                            </span>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <small class="label label-primary">01/10/2016</small>
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></button>
                        @include('helpers.confirm.index',[
                                                                'button' => [
                                                                    'icon'=>'fa-trash-o',
                                                                    'text'=>'',
                                                                    'style'=>'danger btn-sm',
                                                                ],
                                                                'modal' => [
                                                                    'confirm_text' => 'Borrar',
                                                                    'confirm_style' =>'danger',
                                                                    'callback' => '$("#deleteForm'.'s'.'").submit();',
                                                                    'text' => 'Esta seguro que desea borrar el gasto '.'s'."?"
                                                                ]
                                                            ])

                    </div>
                </div>
            </li>
            @foreach($cosplay->tasks as $t)
                <li class="@if($t->status == \App\Task::STATUS_COMPLETED) bg-todo-completed @endif">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="checkbox" value="" name="" class="i-checks" @if($t->status == \App\Task::STATUS_COMPLETED) checked @endif/>
                            <span class="m-l-xs @if($t->status == \App\Task::STATUS_COMPLETED) todo-completed" @endif >{{ $t->name }}</span>
                        </div>
                        @if($t->status == \App\Task::STATUS_COMPLETED)
                            <div class="col-md-2">
                                <small class="label label-primary">{{ Carbon::parse($t->updated_at)->format('d/m/Y') }}</small>
                            </div>
                        @else
                            <div class="col-md-2"></div>
                        @endif
                        <div class="col-md-2 text-right">
                            <button class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></button>
                            @include('helpers.confirm.index',[
                                                                    'button' => [
                                                                        'icon'=>'fa-trash-o',
                                                                        'text'=>'',
                                                                        'style'=>'danger btn-sm',
                                                                    ],
                                                                    'modal' => [
                                                                        'confirm_text' => 'Borrar',
                                                                        'confirm_style' =>'danger',
                                                                        'callback' => '$("#deleteForm'.'s'.'").submit();',
                                                                        'text' => 'Esta seguro que desea borrar el gasto '.'s'."?"
                                                                    ]
                                                                ])

                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
</div>

