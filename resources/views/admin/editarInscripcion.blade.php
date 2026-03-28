@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto space-y-8">

    <!-- TITULO -->

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Editar Inscripción
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            Modifica el alumno o grupo asignado a la inscripción
        </p>

    </div>


    <!-- FORMULARIO -->

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form
            action="{{ route('admin.inscripciones.update', $inscripcion->id) }}"
            method="POST"
            class="space-y-6">

            @csrf
            @method('PUT')


            <!-- ALUMNO -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Alumno
                </label>

                <select
                    name="user_id"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($usuarios as $user)

                    <option
                        value="{{ $user->id }}"
                        {{ $inscripcion->user_id == $user->id ? 'selected' : '' }}
                    >

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

                <select
                    name="grupo_id"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($grupos as $grupo)

                    <option
                        value="{{ $grupo->id }}"
                        {{ $inscripcion->grupo_id == $grupo->id ? 'selected' : '' }}
                    >

                        {{ $grupo->nombre }}

                    </option>

                    @endforeach

                </select>

            </div>


            <!-- BOTONES -->

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                <a
                    href="{{ route('admin.inscripciones') }}"
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