
@extends('welcome')

@section('content')
    
    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <script>
            // Cerrar la alerta automáticamente después de 5 segundos
            setTimeout(function() {
                $('#successAlert').alert('close');
            }, 5000); // 5000 milisegundos = 5 segundos
        </script>
    @endif

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
        Agregar una nueva habitación
    </button>

    <div
        class="table-responsive"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($room_types as $room_type)
                    <tr class="">
                        <td scope="row">{{$room_type->id}}</td>
                        <td>{{$room_type->name}}</td>
                        <td>{{$room_type->quantity}}</td>
                        <td>{{$room_type->price}}</td>
                        <td> <img src="{{ asset('storage/' . $room_type->room_image) }}" alt="" srcset="" class="room_type_img"> </td>

                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar{{$room_type->id}}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar{{$room_type->id}}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    
    @include('Administration.RoomTypesList.addRoomType')
    @include('Administration.RoomTypesList.deleteRoomType')
    @include('Administration.RoomTypesList.updateRoomType')


@endsection