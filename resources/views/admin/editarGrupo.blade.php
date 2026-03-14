@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Editar Grupo
    </h1>

    <!-- ERRORES -->

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white p-6 rounded shadow">

        <form action="{{ route('admin.grupos.update', $grupo->id) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')


            <!-- NOMBRE DEL GRUPO -->

            <div>

                <label class="block text-sm font-semibold mb-1">
                    Nombre del grupo
                </label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ $grupo->nombre }}"
                    required
                    class="border p-2 rounded w-full"
                >

            </div>


            <!-- HORARIO -->

            <div>

                <label class="block text-sm font-semibold mb-1">
                    Horario
                </label>

                <select name="horario_id" required class="border p-2 rounded w-full">

                    @foreach ($horarios as $horario)

                        <option
                            value="{{ $horario->id }}"
                            {{ $grupo->horario_id == $horario->id ? 'selected' : '' }}
                        >

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


            <!-- BOTONES -->

            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('admin.grupos') }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection