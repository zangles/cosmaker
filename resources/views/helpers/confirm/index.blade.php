    @php
        $modalId = mt_rand();
    @endphp
    <button type="button" class="btn btn-{{$button['style']}}" style="@if(isset($button['css'])) {{$button['css']}} @endif" data-toggle="modal" data-target="#myModal{{$modalId}}">
        <i class="fa {{$button['icon']}}" aria-hidden="true" ></i>
        {{$button['text']}}
    </button>

    <div class="modal inmodal" id="myModal{{$modalId}}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated fadeIn">
                <div class="modal-body">
                    <p>{{$modal['text']}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-{{$modal['confirm_style']}}" onclick="{{$modal['callback']}}">{{ (isset($modal['confirm_text']))?$modal['confirm_text']:"Aceptar"  }}</button>
                </div>
            </div>
        </div>
    </div>


