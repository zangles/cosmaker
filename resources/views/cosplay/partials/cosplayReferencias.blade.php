<div class="row m-b-sm m-t-sm">
    <div class="col-md-12 text-right">
        @can('createCost',$cosplay)
            <a type="button" href="{{ route('admin.cosplay.referencias.create',$cosplay) }}" class="btn btn-primary">Nueva Referencia</a>
        @endcan
    </div>
</div>

<div class="col-lg-12">
    <div id="lightgallery">
        @foreach($cosplay->references as $r)
            <div style="display: inline-block; border: 1px solid #dadddf; padding:5px;border-radius: 5px; margin: 15px; background-color: #F3F3F4">
                <div class="galleryThumb" >
                    <a href="{{ asset($r->getFilePath()) }}" class="item">
                        <img src="{{ asset($r->getFileThumbPath()) }}" class="azs" style="border-radius: 5px 5px 0px 0px" />
                    </a>
                </div>
                <div class="ThumbActions" style="margin-top: 0px;border-top: 1px solid #ad404b">
                    @include('helpers.confirm.index',[
                                                        'button' => [
                                                            'icon'=>'fa-trash-o',
                                                            'text'=>'',
                                                            'style'=>'danger btn-sm',
                                                            'css' => 'width:100%;border-radius:0px 0px 5px 5px'
                                                        ],
                                                        'modal' => [
                                                            'confirm_text' => 'Borrar',
                                                            'confirm_style' =>'danger',
                                                            'callback' => '$("#deleteRefForm'.$r->id.'").submit();',
                                                            'text' => 'Esta seguro que desea borrar la referencia? '
                                                        ]
                                                    ])
                    <form method="post" action="{{ route('admin.cosplay.referencias.destroy',[$r->cosplay->id,$r->id]) }}" id="deleteRefForm{{$r->id}}">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>


