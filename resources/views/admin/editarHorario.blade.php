@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Editar Horario
    </h1>

    <div class="bg-white p-6 rounded shadow">

        <form action="{{ route('admin.horarios.update', $horario->id) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')

            <!-- MATERIA -->

            <div>

                <label class="block text-sm font-semibold mb-1">
                    Materia
                </label>

                <select name="materia_id" required class="border p-2 rounded w-full">

                    @foreach ($materias as $materia)
                        <option value="{{ $materia->id }}"
                            {{ $horario->materia_id == $materia->id ? 'selected' : '' }}>

                            {{ $materia->nombre }}

                        </option>
                    @endforeach

                </select>

            </div>


            <!-- MAESTRO -->

            <div>

                <label class="block text-sm font-semibold mb-1">
                    Maestro
                </label>

                <select name="maestro_id" required class="border p-2 rounded w-full">

                    @foreach ($maestros as $maestro)
                        <option value="{{ $maestro->id }}"
                            {{ $horario->maestro_id == $maestro->id ? 'selected' : '' }}>

                            {{ $maestro->nombre }}

                        </option>
                    @endforeach

                </select>

            </div>


            <!-- DIAS -->

            <div>

                <label class="block text-sm font-semibold mb-2">
                    Días de la semana
                </label>

                <div class="grid grid-cols-3 gap-3">

                    @php
                        $diasSemana = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                        $diasSeleccionados = explode(',', $horario->dia);
                    @endphp

                    @foreach ($diasSemana as $dia)

                        <label class="flex items-center gap-2 border rounded p-2 hover:bg-gray-100 cursor-pointer">

                            <input
                                type="checkbox"
                                name="dias[]"
                                value="{{ $dia }}"
                                {{ in_array($dia, $diasSeleccionados) ? 'checked' : '' }}
                            >

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

                    <input
                        type="time"
                        name="hora_inicio"
                        value="{{ $horario->hora_inicio }}"
                        required
                        class="border p-2 rounded w-full"
                    >

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-1">
                        Hora fin
                    </label>

                    <input
                        type="time"
                        name="hora_fin"
                        value="{{ $horario->hora_fin }}"
                        required
                        class="border p-2 rounded w-full"
                    >

                </div>

            </div>


            <!-- BOTONES -->

            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.horarios') }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>
@endsection