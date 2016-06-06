@php
    use Carbon\Carbon;
    use App\User;
@endphp
<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewCost">
                Nuevo Gasto
            </button>
    </div>
</div>


<div class="project-list">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td>01/10/2016</td>
                <td>Goma Eva</td>
                <td>$ 150</td>
                <td>

                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  </a>
                    @include('helpers.confirm.index',[
                                                        'button' => [
                                                            'icon'=>'fa-trash-o',
                                                            'text'=>'',
                                                            'style'=>'danger btn-sm',
                                                        ],
                                                        'modal' => [
                                                            'confirm_text' => 'Borrar',
                                                            'confirm_style' =>'danger',
                                                            'callback' => '$("#deleteForm'."1".'").submit();',
                                                            'text' => 'Esta seguro que desea borrar la parte '."1"."?"
                                                        ]
                                                    ])
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="modal inmodal" id="modalNewCost" tabindex="-1" role="dialog"  aria-hidden="true">

    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title">Nuevo Gasto</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Costo</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control" name="cost" value="{{ old('cost') }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>