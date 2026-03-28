<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Entrega;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;


class TareaController extends Controller
{
public function index()
{

    $user = Auth::user();

    // PROFESOR
    if($user->role == 'Profesor'){

        $grupos = Grupo::whereHas('horario', function($q) use ($user){
            $q->where('maestro_id',$user->id);
        })->get();

        $tareas = Tarea::where('maestro_id',$user->id)->get();

        return view('admin.profesor', compact('grupos','tareas'));
    }

    // ESTUDIANTE
    if($user->role == 'Estudiante'){

        $grupoIds = Inscripcion::where('user_id',$user->id)
                    ->pluck('grupo_id');

        $tareas = Tarea::whereIn('grupo_id',$grupoIds)->get();

        return view('admin.estudiante', compact('tareas'));
    }

}
    public function saveTarea(Request $request)
    {

        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'grupo_id' => $request->grupo_id,
            'maestro_id' => auth::id(),
            'fecha_entrega' => $request->fecha_entrega
        ]);

        return back()->with('success', 'Tarea creada');
    }

    public function entregarTarea(Request $request)
{

    $request->validate([
        'archivo' => 'required|mimes:pdf|max:2048'
    ]);

    $archivo = $request->file('archivo');

    $nombre = time().'_'.$archivo->getClientOriginalName();

    $archivo->move(public_path('entregas'), $nombre);

    Entrega::create([
        'tarea_id' => $request->tarea_id,
        'alumno_id' => auth::id(),
        'archivo_pdf' => $nombre
    ]);

    return back()->with('success','Tarea entregada');
}

public function verEntregas($tarea_id)
{

    $entregas = Entrega::where('tarea_id',$tarea_id)->get();

    return view('admin.entregas', compact('entregas'));
}
}
