@extends('welcome')

@section('content')
    
    <div
        class="table-responsive"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre(s)</th>
                    <th scope="col">Apellido(s)</th>
                    <th scope="col">Numero de Identificación</th>
                    <th scope="col">Nacionalidad</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Tipo de Rol</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fecha que se registro</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="">
                        <td scope="row">{{$user->id}}</td>
                        <td>{{$user->name}} </td>
                        <td>{{$user->last_name}} </td>
                        <td>{{$user->identification_number}} </td>
                        <td>{{$user->nationality->name}} </td>
                        <td>{{$user->birthday}} </td>
                        <td>{{$user->rol->name}} </td>
                        <td>{{$user->phone}} </td>
                        <td>{{$user->email}} </td>
                        <td>{{$user->created_at}} </td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar{{$user->id}}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar{{$user->id}}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @include('Administration.UserList.updateUser')
                    @include('Administration.UserList.deleteUser')
                @endforeach
                
            </tbody>
        </table>
    </div>
    

@endsection