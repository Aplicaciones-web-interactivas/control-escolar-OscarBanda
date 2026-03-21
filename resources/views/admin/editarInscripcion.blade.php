@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Editar Inscripción
    </h1>

    <div class="bg-white p-6 rounded shadow">

        <form action="{{ route('admin.inscripciones.update', $inscripcion->id) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')

            <!-- ALUMNO -->

            <div>

                <label class="block text-sm font-semibold mb-1">
                    Alumno
                </label>

                <select name="user_id" required class="border p-2 rounded w-full">

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

                <label class="block text-sm font-semibold mb-1">
                    Grupo
                </label>

                <select name="grupo_id" required class="border p-2 rounded w-full">

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

            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.inscripciones') }}"
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