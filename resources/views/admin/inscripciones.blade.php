@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- TITULO -->

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Inscripciones
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Administra las inscripciones de alumnos a los grupos
            </p>

        </div>


        <!-- FORMULARIO -->
        @if(Auth::user()->role != 'Estudiante')
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-gray-700 mb-6">
                    Nueva inscripción
                </h2>

                <form action="{{ route('admin.inscripciones.save') }}" method="POST" class="grid md:grid-cols-3 gap-6">

                    @csrf


                    <!-- ALUMNO -->

                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Alumno
                        </label>

                        <select name="user_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach ($usuarios as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->nombre }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- GRUPO -->

                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Grupo
                        </label>

                        <select name="grupo_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id }}">
                                    {{ $grupo->nombre }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- BOTON -->

                    <div class="flex items-end">

                        <button
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg
                    hover:bg-blue-700 transition">

                            Inscribir alumno

                        </button>

                    </div>

                </form>

            </div>
        @endif


        <!-- TABLA -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-700">
                    Inscripciones registradas
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
                                Grupo
                            </th>

                            <th class="px-6 py-3 text-left">
                                Materia
                            </th>

                            @if(Auth::user()->role != 'Estudiante')
                                <th class="px-6 py-3 text-center">
                                    Acciones
                                </th>
                            @endif

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($inscripciones as $inscripcion)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $inscripcion->user->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $inscripcion->grupo->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $inscripcion->grupo->horario->materia->nombre }}
                                </td>

                                <td class="px-6 py-4">
                                    @if(Auth::user()->role != 'Estudiante')
                                        <div class="flex justify-center gap-3">

                                            <a href="{{ route('admin.inscripciones.edit', $inscripcion->id) }}"
                                                class="bg-yellow-400 text-white px-3 py-1.5 rounded-md text-sm hover:bg-yellow-500">

                                                Editar

                                            </a>

                                            <button
                                                onclick="abrirModalEliminar(
                                                    '{{ route('admin.inscripciones.delete', $inscripcion->id) }}',
                                                    'la inscripción de {{ $inscripcion->user->nombre }}'
                                                )"
                                                class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-red-600 transition">

                                                Eliminar

                                            </button>

                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <div class="mt-6 flex justify-center">
                    <nav class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl shadow-sm border">

                        @foreach ($inscripciones->getUrlRange(1, $inscripciones->lastPage()) as $page => $url)
                            @if ($page == $inscripciones->currentPage())
                                <span class="px-3 py-1 rounded-lg bg-blue-600 text-white text-sm">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-3 py-1 rounded-lg text-gray-600 hover:bg-gray-100 text-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                    </nav>
                </div>

            </div>

        </div>

    </div>
@endsection
