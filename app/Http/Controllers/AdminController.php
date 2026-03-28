<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Calificacion;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function indexMaterias()
    {
        $materias = Materia::paginate(10);

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
        $horarios = Horario::with(['materia', 'maestro'])->paginate(10);
        $materias = Materia::all();
        $maestros = User::where('role', 'Profesor')->get();

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
        $maestros = User::where('role', 'Profesor')->get();

        return view('admin.editarHorario', compact('horario', 'materias', 'maestros'));
    }

    public function indexGrupos()
    {
        $user = Auth::user();

        // ADMINISTRADOR
        if ($user->role == 'Administrador') {

            $grupos = Grupo::with('horario.materia', 'horario.maestro')->paginate(10);
            $horarios = Horario::with('materia', 'maestro')->get();

            return view('admin.grupos', compact('grupos', 'horarios'));
        }

        // PROFESOR (solo sus grupos)
        if ($user->role == 'Profesor') {

            $grupos = Grupo::with('horario.materia', 'horario.maestro')
                ->whereHas('horario', function ($q) use ($user) {
                    $q->where('maestro_id', $user->id);
                })
                ->paginate(10);

            $horarios = [];

            return view('admin.grupos', compact('grupos', 'horarios'));
        }
    }

    public function saveGrupo(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'horario_id' => 'required'
        ]);

        Grupo::create([
            'nombre' => $request->nombre,
            'horario_id' => $request->horario_id
        ]);

        return redirect()->route('admin.grupos');
    }

    public function editGrupo($id)
    {
        $grupo = Grupo::findOrFail($id);
        $horarios = Horario::with('materia', 'maestro')->get();

        return view('admin.editarGrupo', compact('grupo', 'horarios'));
    }

    public function updateGrupo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'horario_id' => 'required'
        ]);

        $grupo = Grupo::findOrFail($id);

        $grupo->update([
            'nombre' => $request->nombre,
            'horario_id' => $request->horario_id
        ]);

        return redirect()->route('admin.grupos');
    }

    public function deleteGrupo($id)
    {
        Grupo::findOrFail($id)->delete();

        return redirect()->route('admin.grupos');
    }

    public function indexInscripciones()
    {
        $user = Auth::user();

        // ADMINISTRADOR
        if ($user->role == 'Administrador') {

            $inscripciones = Inscripcion::with(['user', 'grupo'])->paginate(10);
            $usuarios = User::where('role', 'Estudiante')->get();
            $grupos = Grupo::all();

            return view('admin.inscripciones', compact('inscripciones', 'usuarios', 'grupos'));
        }

        // PROFESOR (solo sus grupos)
        if ($user->role == 'Profesor') {

            $grupos = Grupo::whereHas('horario', function ($q) use ($user) {
                $q->where('maestro_id', $user->id);
            })->get();

            $grupoIds = $grupos->pluck('id');

            $inscripciones = Inscripcion::with(['user', 'grupo'])
                ->whereIn('grupo_id', $grupoIds)
                ->paginate(10);

            $usuarios = User::where('role', 'Estudiante')->get();

            return view('admin.inscripciones', compact('inscripciones', 'usuarios', 'grupos'));
        }

        // ESTUDIANTE (solo sus materias)
        if ($user->role == 'Estudiante') {

            $inscripciones = Inscripcion::with(['user', 'grupo.horario.materia'])
                ->where('user_id', $user->id)
                ->paginate(10);

            return view('admin.inscripciones', compact('inscripciones'));
        }
    }

    public function saveInscripcion(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'grupo_id' => 'required'
        ]);

        Inscripcion::create($request->all());

        return redirect()->route('admin.inscripciones');
    }

    public function deleteInscripcion($id)
    {
        Inscripcion::findOrFail($id)->delete();

        return redirect()->route('admin.inscripciones');
    }

    public function editInscripcion($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $usuarios = User::where('role', 'Estudiante')->get();
        $grupos = Grupo::all();

        return view('admin.editarInscripcion', compact('inscripcion', 'usuarios', 'grupos'));
    }

    public function updateInscripcion(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'grupo_id' => 'required'
        ]);

        $inscripcion = Inscripcion::findOrFail($id);

        $inscripcion->update([
            'user_id' => $request->user_id,
            'grupo_id' => $request->grupo_id
        ]);

        return redirect()->route('admin.inscripciones');
    }

    public function indexCalificaciones(Request $request)
    {
        $user = Auth::user();

        // ADMINISTRADOR
        if ($user->role == 'Administrador') {

            $grupos = Grupo::all();

            if ($request->grupo_id) {

                $inscripciones = Inscripcion::with('user', 'grupo')
                    ->where('grupo_id', $request->grupo_id)
                    ->paginate(10);

                $calificaciones = Calificacion::where('grupo_id', $request->grupo_id)
                    ->get()
                    ->keyBy('user_id');

                return view('admin.calificaciones', compact('grupos', 'inscripciones', 'calificaciones'));
            }

            return view('admin.calificaciones', compact('grupos'));
        }


        // PROFESOR
        if ($user->role == 'Profesor') {

            $grupos = Grupo::whereHas('horario', function ($q) use ($user) {
                $q->where('maestro_id', $user->id);
            })->get();

            if ($request->grupo_id) {

                $inscripciones = Inscripcion::with('user', 'grupo')
                    ->where('grupo_id', $request->grupo_id)
                    ->paginate(10);

                $calificaciones = Calificacion::where('grupo_id', $request->grupo_id)
                    ->get()
                    ->keyBy('user_id');

                return view('admin.calificaciones', compact('grupos', 'inscripciones', 'calificaciones'));
            }

            return view('admin.calificaciones', compact('grupos'));
        }


        // ESTUDIANTE
        if ($user->role == 'Estudiante') {

            $inscripciones = Inscripcion::with('grupo.horario.materia')
                ->where('user_id', $user->id)
                ->get();

            $calificaciones = Calificacion::where('user_id', $user->id)
                ->get()
                ->keyBy('grupo_id');

            return view('estudiante.calificaciones_estudiante', compact('inscripciones', 'calificaciones'));
        }
    }

    public function saveCalificacion(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'grupo_id' => 'required',
            'calificacion' => 'required|numeric|min:1|max:10'
        ]);

        Calificacion::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'grupo_id' => $request->grupo_id
            ],
            [
                'calificacion' => $request->calificacion
            ]
        );

        return back();
    }

    public function updateCalificacion(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:10'
        ]);

        $calificacion = Calificacion::findOrFail($id);

        $calificacion->update([
            'calificacion' => $request->calificacion
        ]);

        return redirect()->route('admin.calificaciones');
    }

    public function deleteCalificacion($id)
    {
        Calificacion::findOrFail($id)->delete();

        return redirect()->route('admin.calificaciones');
    }
}
