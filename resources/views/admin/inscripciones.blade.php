@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Inscripciones
    </h1>

    <!-- FORM -->
    <div class="bg-white p-6 rounded shadow mb-8">

        <form action="{{ route('admin.inscripciones.save') }}" method="POST" class="grid grid-cols-3 gap-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-1">Alumno</label>
                <select name="user_id" class="border p-2 rounded w-full">
                    @foreach ($usuarios as $user)
                        <option value="{{ $user->id }}">{{ $user->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Grupo</label>
                <select name="grupo_id" class="border p-2 rounded w-full">
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                    Inscribir
                </button>
            </div>

        </form>

    </div>

    <!-- TABLA -->
    <div class="bg-white rounded shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Alumno</th>
                    <th class="p-3">Grupo</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($inscripciones as $inscripcion)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $inscripcion->user->nombre }}
                    </td>

                    <td class="p-3">
                        {{ $inscripcion->grupo->nombre }}
                    </td>

                    <td class="p-3 flex gap-2">

                        <a href="{{ route('admin.inscripciones.edit', $inscripcion->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Editar
                        </a>

                        <form action="{{ route('admin.inscripciones.delete', $inscripcion->id) }}" method="POST">
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