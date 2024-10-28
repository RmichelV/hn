@extends('welcome');
@section('content')
    <div
        class="table-responsive"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Reservado por:</th>
                    <th scope="col">Tipo de habitación</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">CAntidad de habitaciones</th>
                    <th scope="col">cantidad de huespedes</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Fecha de salida</th>
                    <th scope="col">Precio Total</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr class="">
                    <td scope="row">{{$reservation->id}}</td>
                    <td>{{$reservation->user->name}}</td>
                    <td>{{$reservation->room_type->name}}</td>
                    <td>{{$reservation->room_type->price}}</td>
                    <td>{{$reservation->number_of_rooms}}</td>
                    <td>{{$reservation->number_of_people}}</td>
                    <td>{{$reservation->check_in}}</td>
                    <td>{{$reservation->check_out}}</td>
                    <td>{{$reservation->total_price}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    
@endsection