@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Mis calificaciones
    </h1>

    <div class="bg-white rounded-xl shadow border overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">

                <tr>
                    <th class="px-6 py-3 text-left">Materia</th>
                    <th class="px-6 py-3 text-left">Grupo</th>
                    <th class="px-6 py-3 text-left">Calificación</th>
                </tr>

            </thead>

            <tbody class="divide-y">

                @foreach ($inscripciones as $inscripcion)
                    <tr>

                        <td class="px-6 py-4">
                            {{ $inscripcion->grupo->horario->materia->nombre }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $inscripcion->grupo->nombre }}
                        </td>

                        <td class="px-6 py-4 font-semibold">

                            {{ $calificaciones[$inscripcion->grupo->id]->calificacion ?? 'Sin calificación' }}

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
