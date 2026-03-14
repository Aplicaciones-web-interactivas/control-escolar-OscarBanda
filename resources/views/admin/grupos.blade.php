@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Gestión de Grupos
        </h1>

        <div class="bg-white p-6 rounded shadow mb-8">

            <h2 class="text-xl mb-4">Agregar grupo</h2>

            <form action="{{ route('admin.grupos.save') }}" method="POST" class="space-y-4">

                @csrf

                <div>

                    <label class="block text-sm font-semibold mb-1">
                        Nombre del grupo
                    </label>

                    <input type="text" name="nombre" required class="border p-2 rounded w-full">

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-1">
                        Horario
                    </label>

                    <select name="horario_id" required class="border p-2 rounded w-full">

                        @foreach ($horarios as $horario)
                            <option value="{{ $horario->id }}">

                                {{ $horario->materia->nombre }}
                                -
                                {{ $horario->maestro->nombre }}
                                -
                                {{ $horario->dia }}
                                {{ $horario->hora_inicio }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="flex justify-end">

                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                        Agregar grupo

                    </button>

                </div>

            </form>

        </div>

        <div class="bg-white rounded shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3">Grupo</th>
                        <th class="p-3">Materia</th>
                        <th class="p-3">Maestro</th>
                        <th class="p-3">Horario</th>
                        <th class="p-3">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($grupos as $grupo)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $grupo->nombre }}
                            </td>

                            <td class="p-3">
                                {{ $grupo->horario->materia->nombre }}
                            </td>

                            <td class="p-3">
                                {{ $grupo->horario->maestro->nombre }}
                            </td>

                            <td class="p-3">
                                {{ $grupo->horario->dia }}
                                {{ $grupo->horario->hora_inicio }}
                            </td>

                            <td class="p-3 flex gap-2">

                                <a href="{{ route('admin.grupos.edit', $grupo->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    Editar

                                </a>

                                <form action="{{ route('admin.grupos.delete', $grupo->id) }}" method="POST">

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
