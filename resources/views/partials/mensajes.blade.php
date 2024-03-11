@if (Session::has("error"))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{Session::get("error")}}
    <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (Session::has("mensaje"))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get("mensaje")}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
 @endif