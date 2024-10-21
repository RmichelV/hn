@extends('welcome')

@section('content')
    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar">
        Agregar nuevo Empleado
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
                    <th scope="col">Apellido y Nombre </th>
                    <th scope="col">Fecha de Contratación</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Turno actual</th>
                    <th scope="col">Salario Base</th>
                    <th scope="col">Bono de Antigüedad</th>
                    <th scope="col">Salario Final</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="">
                        <td scope="row">{{$employee->id}}</td>
                        <td>{{$employee->user->last_name}} {{$employee->user->name}} </td>
                        <td>{{$employee->hire_date}}</td>
                        <td>{{$employee->user->rol->name}} </td>
                        <td>{{$employee->shift->name}}</td>
                        <td>{{$employee->salary}}</td>
                        @php
                            $hd = $employee->hire_date;
                            $hdt= new DateTime($hd);
                            $fa = new DateTime();
                            $antig = $hdt->diff($fa);
                            
                            if($antig->y >= 2 && $antig->y <=4 ){
                                $bono = 2500*0.02;
                                $final_salary = $employee->salary + (2500*0.02);
                    
                            }
                            elseif ($antig->y >= 5 && $antig->y <=7) {
                                $bono = 2500*0.05;
                                $final_salary = $employee->salary + (2500*0.05);
                            }
                            elseif ($antig->y >= 8 && $antig->y <=10 ) {
                                $bono = 2500*0.11;
                                $final_salary = $employee->salary + (2500*0.11);
                            }
                            elseif ($antig->y >= 11 && $antig->y <=14) {
                                $bono = 2500*0.18;
                                $final_salary = $employee->salary + (2500*0.18);
                            }
                            elseif ($antig->y >= 15 && $antig->y <=19) {
                                $bono = 2500*0.26;
                                $final_salary = $employee->salary + (2500*0.26);
                            }
                            else {
                                $bono = 2500*0.34;
                                $final_salary = $employee->salary + (2500*0.34);
                            }

                            
                        @endphp

                        <td> {{$bono}}</td>
                        <td>{{$final_salary}} </td>

                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editar{{$employee->id}}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar{{$employee->id}}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    
    @include('Administration.EmployeeList.addEmployee')
    {{-- @include('Administration.EmployeeList.updateEmployee')
    @include('Administration.EmployeeList.deleteEmployee') --}}

@endsection