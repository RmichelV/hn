<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

//librerias agregadas
use App\Models\User;
use App\Models\Room_type;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        $users = User::all();
        $room_types = Room_type::all();

        return view('reservation',compact('reservations','users','room_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'check_in' => [
                'required',
                'date',
                'before:check_out',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->isPast()) {
                        $fail('La fecha de entrada no puede ser anterior a hoy.');
                    }
                },
            ],
            'check_out' => [
                'required',
                'date',
                'after:check_in',
                function ($attribute, $value, $fail) {
                    $maxDate = Carbon::now()->addMonths(18);
                    if (Carbon::parse($value)->isAfter($maxDate)) {
                        $fail('La fecha de salida no puede ser más de un año y medio a partir de hoy.');
                    }
                },
            ],
            'room_type' => 'required|exists:room_types,id',
            'number_of_rooms' => 'required|integer|min:1',
        ],[
            'check_in.required'=>'Debe ingresar una fecha',
            'check_in.before:check_out'=>'Debe ingresar una fecha anterior a la fecha de salida',
            'check_out.required'=>'Debe ingresar una fecha',
            'check_out.after:check_in'=>'Debe ingresar una fecha posterior al check_in',
            'number_of_rooms.min'=>'Debe ingresar un valor mayor o igual a 1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_id', 'agregar') ; 
        }

        // Obtener el tipo de habitación seleccionado
        $roomType = Room_Type::find($request->room_type);
        
        // Contar cuántas habitaciones ya están reservadas en ese rango de fechas
        $reservedRooms = Reservation::where('room_type_id', $request->room_type_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                    ->orWhere(function($query) use ($request) {
                $query->where('check_in', '<=', $request->check_in)
                    ->where('check_out', '>=', $request->check_out);
                    });
            })
            ->sum('number_of_rooms');
        
        // Comparar si quedan habitaciones disponibles
        if ($reservedRooms + $request->number_of_rooms > $roomType->quantity) {
            return redirect()->back()->withErrors(['No hay suficientes habitaciones disponibles para las fechas seleccionadas.']);
        }

        $user = Auth::User()->id;

        $reservation = new Reservation();
        $reservation->user_id = $user;
        $reservation->room_type_id = $request->input('room_type');
        $reservation->number_of_rooms = $request->input('number_of_rooms');
        $reservation->number_of_people = $request->input('number_of_people');
        $reservation->check_in = $request->input('check_in');
        $reservation->check_out = $request->input('check_out');
        $reservation->total_price = $request->input('total_price');

        // dd($request->all());
        $reservation->save();

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }
    public function reservationList(){
        $reservations = Reservation::all();
        $users = User::all();
        $room_types = Room_type::all();

        return view('Administration.ReservationsList.index',compact('reservations','users','room_types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
