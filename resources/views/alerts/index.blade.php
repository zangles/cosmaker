@if (Session::has('message'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p>{{ Session::get('message') }}</p>
    </div>
@endif
@if (Session::has('errors'))
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p>{{ Session::get('errors') }}</p>
    </div>
@endif