<?php

namespace App\Http\Controllers;

use App\Models\Room_type;
use Illuminate\Http\Request;

//librerias agregadas
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room_types = Room_type::all();

        return view('Administration.RoomTypesList.index', compact('room_types'));
    }

    public function welcome()
    {
        $room_types = Room_type::all();

        return view('welcome', compact('room_types'));
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
            'name'=>[
                'required',
                'string', 
                'max:255', 
                'unique:'.Room_type::class,
                'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'quantity'=>[
                'integer',
                'regex:/^[0-9]{1,2}$/'
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
                'min:25',  
                'max:700', 
            ],
        ],[
            'name.required'=>'Debe introducir un nombre para el tipo de habitación que se agregará',
            'name.string' => 'El nombre no debe contener números',
            'name.regex' => 'Cada nombre debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'name.unique' => 'El tipo de habitación que intentaste ingresar ya existe',
            'quantity.integer' => 'El numero ingresado debe ser entero (Ej. 1, 2, 3, etc)',
            'quantity.regex'=> 'El número ingresado debe estar entre 1 y 99',
            'price.required'=>'por favor introduzca un valor para el salario',
            'price.regex'=>'por favor introduzca un valor con hasta dos decimales',
            'price.min'=>'El salario no debe ser menor a Bs. 25',
            'price.max'=>'El salario no debe ser mayor a Bs. 700',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_id', 'agregar') ; 
        }

        $room_type = new Room_type();
        $room_type->name = $request->input('name');
        $room_type->quantity = $request->input('quantity');
        $room_type->price = $request->input('price');

        if ($request->hasFile('room_image')) {
            $room_image = $request->file('room_image');
            $nombreImagen = $room_type->name . "." . $room_image->extension();
            $ruta = $room_image->storeAs('', $nombreImagen, 'public');
            
            $room_type->room_image = $ruta; 
        }
        
        $room_type->save();

        return redirect()->back()->with('message','habitación agregada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room_type $room_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room_type $room_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room_type = Room_type::find($id);
        
        $validator = Validator::make($request->all(),[
            'name'=>[
                'required',
                'string', 
                'max:255', 
                'unique:'.Room_type::class,
                'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'quantity'=>[
                'integer',
                'regex:/^[0-9]{1,2}$/'
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
                'min:25',  
                'max:700', 
            ],
        ],[
            'name.required'=>'Debe introducir un nombre para el tipo de habitación que se agregará',
            'name.string' => 'El nombre no debe contener números',
            'name.regex' => 'Cada nombre debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'name.unique' => 'El tipo de habitación que intentaste ingresar ya existe',
            'quantity.integer' => 'El numero ingresado debe ser entero (Ej. 1, 2, 3, etc)',
            'quantity.regex'=> 'El número ingresado debe estar entre 1 y 99',
            'price.required'=>'por favor introduzca un valor para el salario',
            'price.regex'=>'por favor introduzca un valor con hasta dos decimales',
            'price.min'=>'El salario no debe ser menor a Bs. 25',
            'price.max'=>'El salario no debe ser mayor a Bs. 700',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_id', 'editar') ; 
        }

        $room_type->name = $request->input('name');
        $room_type->quantity = $request->input('quantity');
        $room_type->price = $request->input('price');

        if ($request->hasFile('room_image')) {
            $room_image = $request->file('room_image');
            $nombreImagen = $room_type->name . "." . $room_image->extension();
            $ruta = $room_image->storeAs('', $nombreImagen, 'public');
            
            $room_type->room_image = $ruta; 
        }
        
        $room_type->save();

        return redirect()->back()->with('message','habitación actualizada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room_type = Room_type::find($id);

        $room_type->delete();

        return redirect()->back()->with('messege','habitación eliminada correctamente');

    }
}
