@extends('layouts.app')

@section('content')

    <div class="space-y-8">

        <!-- TITULO -->

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Calificaciones
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Asigna o actualiza las calificaciones de los alumnos por grupo
            </p>

        </div>


        <!-- SELECCIONAR GRUPO -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-700 mb-6">
                Seleccionar grupo
            </h2>

            <form method="GET" class="flex flex-wrap gap-4 items-end">

                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Grupo
                    </label>

                    <select name="grupo_id"
                        class="border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>

                                {{ $grupo->nombre }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg
                hover:bg-blue-700 transition">

                    Mostrar alumnos

                </button>

            </form>

        </div>



        <!-- TABLA DE ALUMNOS -->

        @if (isset($inscripciones))
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h2 class="text-lg font-semibold text-gray-700">
                        Lista de alumnos
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                            <tr>

                                <th class="px-6 py-3 text-left">
                                    Alumno
                                </th>

                                <th class="px-6 py-3 text-left">
                                    Calificación
                                </th>

                                <th class="px-6 py-3 text-center">
                                    Acción
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @foreach ($inscripciones as $inscripcion)
                                <tr class="hover:bg-gray-50 transition">

                                    <form action="{{ route('admin.calificaciones.save') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $inscripcion->user->id }}">
                                        <input type="hidden" name="grupo_id" value="{{ $inscripcion->grupo->id }}">

                                        <!-- ALUMNO -->

                                        <td class="px-6 py-4 font-medium text-gray-800">

                                            {{ $inscripcion->user->nombre }}

                                        </td>


                                        <!-- CALIFICACION -->

                                        <td class="px-6 py-4">

                                            <input type="number" name="calificacion" step="0.1" min="1"
                                                max="10"
                                                value="{{ $calificaciones[$inscripcion->user->id]->calificacion ?? '' }}"
                                                class="w-24 border border-gray-300 rounded-lg px-2 py-1
                                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                        </td>


                                        <!-- BOTON -->

                                        <td class="px-6 py-4">

                                            <div class="flex justify-center">

                                                <button
                                                    class="bg-green-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-green-700">

                                                    Guardar

                                                </button>

                                            </div>

                                        </td>

                                    </form>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    

                </div>

            </div>
        @endif

    </div>

@endsection
