<!-- Modal ELIMINAR-->
@foreach ($room_types as $room_type)
<div class="modal fade" id="eliminar{{$room_type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ELIMINAR HABITACIÓN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('room_types.destroy',$room_type->id)}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Estas seguro de eliminar la habitación <strong>{{$room_type->name}} ? </strong>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach