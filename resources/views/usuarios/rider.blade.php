<form action="{{action([App\Http\Controllers\RiderController::class,'store'])}}" class="row" method="POST" hidden>   
    @csrf

    <label for="id">
        id
    </label>
    <div>
        <input type="text" id="id" name="Id" value="{{$id}}" readonly>
    </div>

    <label for="apellidos">
        Apellidos
    </label>
    <div>
        <input type="text" id="apellidos" name="Apellidos" value="{{$apellidos}}" readonly>
    </div>

    <label for="nickname">
        Nickname
    </label>
    <div>
        <input type="text" id="nickname" name="Nickname" value="{{$nickname}}" readonly>
    </div>

    <label for="avatar">
        Avatar
    </label>
    <div>
        <input type="text" id="avatar" name="Avatar" value="{{$avatar}}" readonly>
    </div>

    <button type="submit">
        Aceptar
    </button>
</form>
<script>
    let boton=document.getElementsByTagName("button")[0];
    boton.click();
</script>