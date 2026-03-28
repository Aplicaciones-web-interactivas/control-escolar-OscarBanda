@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- TITULO -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Gestión de Horarios
            </h1>
            <p class="text-gray-500 text-sm mt-1">
                Administra los horarios de las materias y profesores
            </p>
        </div>


        <!-- FORMULARIO -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-700 mb-6">
                Agregar nuevo horario
            </h2>

            <form action="{{ route('admin.horarios.save') }}" method="POST" class="space-y-6">

                @csrf


                <!-- MATERIA Y MAESTRO -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Materia
                        </label>

                        <select name="materia_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Profesor
                        </label>

                        <select name="maestro_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                            @foreach ($maestros as $maestro)
                                <option value="{{ $maestro->id }}">
                                    {{ $maestro->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>


                <!-- DIAS -->
                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Días de la semana
                    </label>

                    @php
                        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                    @endphp

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                        @foreach ($dias as $dia)
                            <label
                                class="flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-2
                                   hover:bg-gray-50 cursor-pointer">

                                <input type="checkbox" name="dias[]" value="{{ $dia }}" class="accent-blue-600">

                                <span class="text-sm text-gray-700">
                                    {{ $dia }}
                                </span>

                            </label>
                        @endforeach

                    </div>

                </div>


                <!-- HORAS -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Hora de inicio
                        </label>

                        <input type="time" name="hora_inicio" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Hora de fin
                        </label>

                        <input type="time" name="hora_fin" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                </div>


                <!-- BOTON -->
                <div class="flex justify-end pt-4 border-t border-gray-200">

                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg
                hover:bg-blue-700 transition">

                        Agregar horario

                    </button>

                </div>

            </form>

        </div>



        <!-- TABLA -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-700">
                    Horarios registrados
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                        <tr>

                            <th class="px-6 py-3 text-left">Materia</th>
                            <th class="px-6 py-3 text-left">Profesor</th>
                            <th class="px-6 py-3 text-left">Día</th>
                            <th class="px-6 py-3 text-left">Inicio</th>
                            <th class="px-6 py-3 text-left">Fin</th>
                            <th class="px-6 py-3 text-center">Acciones</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($horarios as $horario)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $horario->materia->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $horario->maestro->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $horario->dia }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $horario->hora_inicio }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $horario->hora_fin }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center gap-3">

                                        <a href="{{ route('admin.horarios.edit', $horario->id) }}"
                                            class="bg-yellow-400 text-white px-3 py-1.5 rounded-md text-sm hover:bg-yellow-500">

                                            Editar

                                        </a>

                                        <button
                                            onclick="abrirModalEliminar(
                                                '{{ route('admin.horarios.delete', $horario->id) }}',
                                                'el horario {{ $horario->dia }} {{ $horario->hora_inicio }}'
                                            )"
                                            class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-red-600 transition">

                                            Eliminar

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <div class="mt-6 flex justify-center">
                    <nav class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl shadow-sm border">

                        @foreach ($horarios->getUrlRange(1, $horarios->lastPage()) as $page => $url)
                            @if ($page == $horarios->currentPage())
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
