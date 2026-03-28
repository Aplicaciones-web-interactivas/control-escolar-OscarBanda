@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto space-y-8">

    <!-- TITULO -->

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Editar Grupo
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            Modifica la información del grupo seleccionado
        </p>

    </div>


    <!-- ERRORES -->

    @if ($errors->any())

    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">

        <ul class="list-disc list-inside text-sm">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif


    <!-- FORMULARIO -->

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form
            action="{{ route('admin.grupos.update', $grupo->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')


            <!-- NOMBRE -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nombre del grupo
                </label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ $grupo->nombre }}"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >

            </div>


            <!-- HORARIO -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Horario
                </label>

                <select
                    name="horario_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($horarios as $horario)

                    <option
                        value="{{ $horario->id }}"
                        {{ $grupo->horario_id == $horario->id ? 'selected' : '' }}
                    >

                        {{ $horario->materia->nombre }}
                        |
                        {{ $horario->maestro->nombre }}
                        |
                        {{ $horario->dia }}
                        {{ $horario->hora_inicio }}

                    </option>

                    @endforeach

                </select>

            </div>


            <!-- BOTONES -->

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a
                    href="{{ route('admin.grupos') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                    bg-gray-200 text-gray-700 hover:bg-gray-300 transition"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg text-sm font-medium
                    bg-blue-600 text-white hover:bg-blue-700 transition"
                >
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection