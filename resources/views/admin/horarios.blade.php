@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Gestión de Horarios
        </h1>

        <!-- FORMULARIO -->

        <div class="bg-white p-6 rounded shadow mb-8">

            <h2 class="text-xl mb-4">Agregar horario</h2>

            <form action="{{ route('admin.horarios.save') }}" method="POST" class="space-y-6">

                @csrf

                <!-- MATERIA Y MAESTRO -->

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Materia
                        </label>

                        <select name="materia_id" required class="border p-2 rounded w-full">

                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Maestro
                        </label>

                        <select name="maestro_id" required class="border p-2 rounded w-full">

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

                    <label class="block text-sm font-semibold mb-2">
                        Días de la semana
                    </label>

                    <div class="grid grid-cols-4 gap-2">

                        @php
                            $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                        @endphp

                        @foreach ($dias as $dia)
                            <label class="flex items-center gap-2 border rounded p-2 hover:bg-gray-100">

                                <input type="checkbox" name="dias[]" value="{{ $dia }}">
                                {{ $dia }}

                            </label>
                        @endforeach

                    </div>

                </div>


                <!-- HORAS -->

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Hora inicio
                        </label>

                        <input type="time" name="hora_inicio" required class="border p-2 rounded w-full">
                    </div>


                    <div>
                        <label class="block text-sm font-semibold mb-1">
                            Hora fin
                        </label>

                        <input type="time" name="hora_fin" required class="border p-2 rounded w-full">
                    </div>

                </div>


                <!-- BOTON -->

                <div class="flex justify-end">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                        Agregar horario

                    </button>

                </div>

            </form>

        </div>

        <!-- TABLA -->

        <div class="bg-white rounded shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3">Materia</th>
                        <th class="p-3">Maestro</th>
                        <th class="p-3">Día</th>
                        <th class="p-3">Inicio</th>
                        <th class="p-3">Fin</th>
                        <th class="p-3">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($horarios as $horario)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $horario->materia->nombre }}
                            </td>

                            <td class="p-3">
                                {{ $horario->maestro->nombre }}
                            </td>

                            <td class="p-3">
                                {{ $horario->dia }}
                            </td>

                            <td class="p-3">
                                {{ $horario->hora_inicio }}
                            </td>

                            <td class="p-3">
                                {{ $horario->hora_fin }}
                            </td>

                            <td class="p-3 flex gap-2">

                                <a href="{{ route('admin.horarios.edit', $horario->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Editar
                                </a>

                                <form action="{{ route('admin.horarios.delete', $horario->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-500 text-white px-3 py-1 rounded">
                                        Eliminar
                                    </button>

                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
@endsection
