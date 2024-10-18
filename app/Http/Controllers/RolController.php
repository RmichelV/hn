<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

//Agregando nuevas librerias
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rols = Rol::all();

        return view('rols.index', compact('rols'));
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

        $rol = new Rol([
            'name' => $request->input('name') // Asignar correctamente el nombre aquí
        ]);
        
        $rol->save();

        return redirect()->route('rols.index')->with('success', 'Rol creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);

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

        $rol->name = $request->input('name');

        $rol->save();
        
        return redirect()->route('rols.index')->with('success', 'Rol actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol=Rol::find($id);
        $rol->delete();
        return redirect()->route('rols.index')->with('success', 'Rol eliminado con éxito.');
    }
}
