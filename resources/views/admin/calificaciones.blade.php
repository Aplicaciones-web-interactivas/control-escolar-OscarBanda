@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Calificaciones
        </h1>

        <!-- SELECCIONAR GRUPO -->

        <div class="bg-white p-6 rounded shadow mb-8">

            <form method="GET" class="flex gap-4 items-end">

                <div>
                    <label class="block text-sm font-semibold mb-1">
                        Grupo
                    </label>

                    <select name="grupo_id" class="border p-2 rounded">

                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>

                                {{ $grupo->nombre }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Mostrar alumnos
                </button>

            </form>

        </div>


        <!-- TABLA DE ALUMNOS -->

        @if (isset($inscripciones))
            <div class="bg-white rounded shadow overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Alumno</th>
                            <th class="p-3">Calificación</th>
                            <th class="p-3">Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($inscripciones as $inscripcion)
                            <tr class="border-t">

                                <form action="{{ route('admin.calificaciones.save') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $inscripcion->user->id }}">
                                    <input type="hidden" name="grupo_id" value="{{ $inscripcion->grupo->id }}">

                                    <td class="p-3">
                                        {{ $inscripcion->user->nombre }}
                                    </td>

                                    <td class="p-3">

                                        <input type="number" name="calificacion" step="0.1" min="1"
                                            max="10"
                                            value="{{ $calificaciones[$inscripcion->user->id]->calificacion ?? '' }}"
                                            class="border p-1 rounded w-24">

                                    </td>

                                    <td class="p-3">

                                        <button class="bg-green-600 text-white px-3 py-1 rounded">
                                            Guardar
                                        </button>

                                    </td>

                                </form>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        @endif

    </div>
@endsection
