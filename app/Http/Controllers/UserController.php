<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

//Librerias agregadas
use App\Models\Rol;
use App\Models\Nationality;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $rols = Rol::all();
        $nationalities = Nationality::all();
        
        return view('User.index', compact('users','rols','nationalities'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        $validator = Validator::make($request->all(),[
            'name'=>[
                'string', 
                'max:255', 
                'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'last_name'=>[
                'string', 
                'max:255', 
                'regex:/^([A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)(\s[A-ZÁÉÍÓÚÑÇĆ][a-záéíóúñçć]+)*$/'],
            'identification_number'=>[
                'regex:/^[0-9]{4,10}$/'],
            'nationality_id' => [
                'required',
                'exists:nationalities,id'],
            'birthday' => [
                'date',
                function ($attribute, $value, $fail) {
                    $birthday = Carbon::parse($value);
                    $today = Carbon::now();
                    $age = $birthday->age;

                    if ($age < 18) {
                        $fail('Debe tener al menos 18 años.');
                    } elseif ($age > 88) {
                        $fail('Debe tener como máximo 88 años.');
                    }
                },],  
            'rol_id'=>[
                'required'.
                'exists:rols,id'],
            'phone'=>[
                'nullable',
                'regex:/^[0-9]{6,10}$/'],
            'email' => [
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $user->id ]
        ],[
            'name.regex' => 'El nombre debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'last_name.regex' => 'El apellido debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'identification_number.regex' => 'El número de identidad debe contener entre 4 y 10 dígitos.',
            'nationality_id.exists' => 'La nacionalidad seleccionada no es válida.',
            'birthday.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'rol_id.exists' => 'El rol seleccionado no es válida.',
            'phone.regex' => 'El teléfono debe contener entre 6 y 10 dígitos.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',
        ]);

        $user->name = $request->input('name');
        $user->last_name = $request->input('Last_name');
        $user->identification_number = $request->input('identification_number');
        $user->nationality_id = $request->input('nationality');
        $user->birthday= $request->input('birthday');
        $user->rol = $request->input('rol');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        $user->update();

        return redirect()->route('users.index')->with('success','usuario eliminado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('users.index')->with('success','usuario eliminado correctamente');
    }
}
