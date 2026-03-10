<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class AdminController extends Controller
{

    public function indexMaterias()
    {
        $materias = Materia::all();

        return view('admin.materias', compact('materias'));
    }

    public function saveMateria(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'clave' => 'required|unique:materias'
        ]);

        Materia::create([
            'nombre' => $request->nombre,
            'clave' => $request->clave
        ]);

        return redirect()->route('admin.materias');
    }

    public function deleteMateria($id)
    {
        Materia::findOrFail($id)->delete();

        return redirect()->route('admin.materias');
    }

    public function editMateria($id)
    {
        $materia = Materia::findOrFail($id);

        return view('admin.editarMateria', compact('materia'));
    }

    public function updateMateria(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $materia->update([
            'nombre' => $request->nombre,
            'clave' => $request->clave
        ]);

        return redirect()->route('admin.materias');
    }

}