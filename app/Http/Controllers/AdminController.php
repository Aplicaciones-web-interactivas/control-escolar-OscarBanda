<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\User;

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

    public function indexHorarios()
    {
        $horarios = Horario::with(['materia', 'maestro'])->get();
        $materias = Materia::all();
        $maestros = User::all();

        return view('admin.horarios', compact('horarios', 'materias', 'maestros'));
    }

    public function saveHorario(Request $request)
    {
        $request->validate([
            'materia_id' => 'required',
            'maestro_id' => 'required',
            'dias' => 'required|array|min:1',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ]);

        $dias = implode(',', $request->dias);

        Horario::create([
            'materia_id' => $request->materia_id,
            'maestro_id' => $request->maestro_id,
            'dia' => $dias,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);

        return redirect()->route('admin.horarios');
    }

    public function updateHorario(Request $request, $id)
    {
        $request->validate([
            'materia_id' => 'required',
            'maestro_id' => 'required',
            'dias' => 'required|array|min:1',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ], [
            'dias.required' => 'Debes seleccionar al menos un día'
        ]);;

        $horario = Horario::findOrFail($id);

        $dias = implode(',', $request->dias);

        $horario->update([
            'materia_id' => $request->materia_id,
            'maestro_id' => $request->maestro_id,
            'dia' => $dias,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);

        return redirect()->route('admin.horarios');
    }

    public function deleteHorario($id)
    {
        Horario::findOrFail($id)->delete();

        return redirect()->route('admin.horarios');
    }

    public function editHorario($id)
    {
        $horario = Horario::findOrFail($id);
        $materias = Materia::all();
        $maestros = User::all();

        return view('admin.editarHorario', compact('horario', 'materias', 'maestros'));
    }
}
