@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- TITULO -->
        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Gestión de Grupos
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Administra los grupos asociados a los horarios disponibles
            </p>

        </div>


        <!-- FORMULARIO -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-gray-700 mb-6">
                Agregar nuevo grupo
            </h2>

            <form action="{{ route('admin.grupos.save') }}" method="POST" class="space-y-6">

                @csrf


                <!-- NOMBRE -->

                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nombre del grupo
                    </label>

                    <input type="text" name="nombre" required placeholder="Ej. Grupo A"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>


                <!-- HORARIO -->

                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Horario
                    </label>

                    <select name="horario_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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


                <!-- BOTON -->

                <div class="flex justify-end pt-4 border-t border-gray-200">

                    <button
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg
                hover:bg-blue-700 transition">

                        Agregar grupo

                    </button>

                </div>

            </form>

        </div>



        <!-- TABLA -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-700">
                    Grupos registrados
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                        <tr>

                            <th class="px-6 py-3 text-left">Grupo</th>
                            <th class="px-6 py-3 text-left">Materia</th>
                            <th class="px-6 py-3 text-left">Profesor</th>
                            <th class="px-6 py-3 text-left">Horario</th>
                            <th class="px-6 py-3 text-center">Acciones</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($grupos as $grupo)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $grupo->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $grupo->horario->materia->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $grupo->horario->maestro->nombre }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $grupo->horario->dia }}
                                    {{ $grupo->horario->hora_inicio }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="flex justify-center gap-3">

                                        <a href="{{ route('admin.grupos.edit', $grupo->id) }}"
                                            class="bg-yellow-400 text-white px-3 py-1.5 rounded-md text-sm hover:bg-yellow-500">

                                            Editar

                                        </a>

                                        <button
                                            onclick="abrirModalEliminar(
                                                '{{ route('admin.grupos.delete', $grupo->id) }}',
                                                'el grupo {{ $grupo->nombre }}'
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

                        @foreach ($grupos->getUrlRange(1, $grupos->lastPage()) as $page => $url)
                            @if ($page == $grupos->currentPage())
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
