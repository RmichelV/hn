<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

//Agregando nuevas librerias
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nationalities = Nationality::all();

        return view('Nationalities.index', compact('nationalties'));
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
        $validator = validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('rols', 'name'),
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'            ]
            ],[
                'name.required' => 'El nombre es obligatorio.',
                'name.unique' => 'El nombre ya está en uso.',
                'name.regex' => 'El nombre debe comenzar con una letra mayúscula seguida de letras minúsculas. Excepciones: "de", "la", "del", etc.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nationality = new Nationality([
            'name' => $request->input('name') // Asignar correctamente el nombre aquí
        ]);
        
        $nationality->save();

        return redirect()->route('nationalities.index')->with('success', 'Nacionalidad creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nationality = Nationality::find($id);

        $validator = validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('rols', 'name'),
                'string',
                'regex:/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*(?: (de[l]?|Del|La|Los|Las|República|Democrática|del))?(?: [A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/'            ]
            ],[
                'name.required' => 'El nombre es obligatorio.',
                'name.unique' => 'El nombre ya está en uso.',
                'name.regex' => 'El nombre debe comenzar con una letra mayúscula seguida de letras minúsculas. Excepciones: "de", "la", "del", etc.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nationality->name = $request->input('name');

        $nationality->save();
        
        return redirect()->route('nationalities.index')->with('success', 'Nacionalidad actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nationality = Nationality::find($id);
        $nationality->delete();

        return redirect()->route('nationalities.index')->with('success', 'Nacionalidad actualizada con éxito.');

    }
}
