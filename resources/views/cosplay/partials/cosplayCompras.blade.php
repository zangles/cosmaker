@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row m-b-sm m-t-sm">
    <div class="col-md-4 text-left">
        Total Gastos: <strong>$ {{ $cosplay->totalCost() }}</strong>
    </div>
    <div class="col-md-8 text-right">
        @can('createCost',$cosplay)
            <a type="button" href="{{ route('admin.cosplay.gastos.create',$cosplay) }}" class="btn btn-primary">Nuevo Gasto</a>
        @endcan
    </div>
</div>

<div class="project-list">
    <table class="table table-hover">
        <tbody>
        @foreach($cosplay->costs as $c)
            <tr>
                <td>{{ Carbon::parse($c->created_at)->format('d/m/Y') }}</td>
                <td>{{ $c->name }}</td>
                <td>$ {{ $c->cost }}</td>
                <td>
                    @can('edit',$c)
                        <a href="{{ route('admin.cosplay.gastos.edit',[$cosplay,$c]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>  </a>
                    @endcan
                    @can('delete',$c)
                        @include('helpers.confirm.index',[
                                                            'button' => [
                                                                'icon'=>'fa-trash-o',
                                                                'text'=>'',
                                                                'style'=>'danger btn-sm',
                                                            ],
                                                            'modal' => [
                                                                'confirm_text' => 'Borrar',
                                                                'confirm_style' =>'danger',
                                                                'callback' => '$("#deleteCostForm'.$c->id.'").submit();',
                                                                'text' => 'Esta seguro que desea borrar el gasto '.$c->name."?"
                                                            ]
                                                        ])
                        <form method="post" action="{{ route('admin.cosplay.gastos.destroy',[$c->cosplay->id,$c->id]) }}" id="deleteCostForm{{$c->id}}">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>