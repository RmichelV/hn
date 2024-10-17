<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

//librerias agregadas:
use App\Models\Rol;
use App\Models\Nationality;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
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
            'phone'=>[
                'nullable',
                'regex:/^[0-9]{6,10}$/'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],[
            'name.regex' => 'El nombre debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'last_name.regex' => 'El apellido debe comenzar con una letra mayúscula y estar seguido de letras minúsculas.',
            'identification_number.regex' => 'El número de identidad debe contener entre 4 y 10 dígitos.',
            'nationality_id.exists' => 'La nacionalidad seleccionada no es válida.',
            'birthday.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'phone.regex' => 'El teléfono debe contener entre 6 y 10 dígitos.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password' => 'La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
        ]);
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'identification_number'=>$request->identification_number,
            'nationality_id'=>$request->nationality_id,
            'rol_id'=> 3,
            'phone'=>$request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
