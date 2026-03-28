@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto space-y-8">

    <!-- TITULO -->
    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Editar Horario
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            Modifica la información del horario seleccionado
        </p>

    </div>


    <!-- FORMULARIO -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form action="{{ route('admin.horarios.update', $horario->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')


            <!-- MATERIA -->
            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Materia
                </label>

                <select name="materia_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Profesor
                </label>

                <select name="maestro_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Días de la semana
                </label>

                @php
                    $diasSemana = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                    $diasSeleccionados = explode(',', $horario->dia);
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                    @foreach ($diasSemana as $dia)

                    <label class="flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-2
                                   hover:bg-gray-50 cursor-pointer">

                        <input
                            type="checkbox"
                            name="dias[]"
                            value="{{ $dia }}"
                            class="accent-blue-600"
                            {{ in_array($dia, $diasSeleccionados) ? 'checked' : '' }}
                        >

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

                    <input
                        type="time"
                        name="hora_inicio"
                        value="{{ $horario->hora_inicio }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Hora de fin
                    </label>

                    <input
                        type="time"
                        name="hora_fin"
                        value="{{ $horario->hora_fin }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

            </div>


            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('admin.horarios') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium
                   bg-gray-200 text-gray-700 hover:bg-gray-300 transition">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                    bg-blue-600 text-white hover:bg-blue-700 transition">

                    Guardar cambios

                </button>

            </div>

        </form>

    </div>

</div>

@endsection