<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        @can('createCost',$cosplay)
            <a type="button" href="{{ route('admin.cosplay.tareas.create',$cosplay) }}" class="btn btn-primary">Nueva Referencia</a>
        @endcan
    </div>
</div>

<div class="col-lg-12">
    <div id="lightgallery">
        @for($i = 1 ; $i <= 5; $i++)
            <div style="display: inline-block;">
                <div class="galleryThumb">
                    <a href="{{ asset('/img/test/0'.$i.'.jpg') }}" class="item">
                        <img src="{{ asset('/img/test/0'.$i.'.jpg') }}" class="azs" />
                    </a>
                </div>
                <div class="ThumbActions" style="padding-top: 5px; padding-bottom: 10px">
                    @include('helpers.confirm.index',[
                                                        'button' => [
                                                            'icon'=>'fa-trash-o',
                                                            'text'=>'',
                                                            'style'=>'danger btn-sm',
                                                            'css' => 'width:100%'
                                                        ],
                                                        'modal' => [
                                                            'confirm_text' => 'Borrar',
                                                            'confirm_style' =>'danger',
                                                            'callback' => '$("#deletePartForm").submit();',
                                                            'text' => 'Esta seguro que desea borrar la imagen? '
                                                        ]
                                                    ])
                </div>
            </div>
        @endfor
    </div>
</div>


