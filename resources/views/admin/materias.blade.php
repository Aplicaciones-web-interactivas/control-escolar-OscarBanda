@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-10">

        <div class="max-w-6xl mx-auto space-y-8">

            <!-- TITULO -->
            <div class="flex items-center justify-between">

                <h1 class="text-3xl font-bold text-gray-800">
                    Gestión de Materias
                </h1>

            </div>


            <!-- FORMULARIO -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-gray-700 mb-6">
                    Agregar nueva materia
                </h2>

                <form action="{{ route('admin.materias.save') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @csrf

                    <!-- NOMBRE -->
                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Nombre de la materia
                        </label>

                        <input type="text" name="nombre" required placeholder="Ej. Programación Web"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        outline-none transition">

                    </div>


                    <!-- CLAVE -->
                    <div>

                        <label class="block text-sm font-medium text-gray-600 mb-1">
                            Clave
                        </label>

                        <input type="text" name="clave" required placeholder="Ej. M001"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        outline-none transition">

                    </div>


                    <!-- BOTON -->
                    <div class="flex items-end">

                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-medium
                        py-2.5 rounded-lg
                        hover:bg-blue-700
                        transition">

                            Agregar Materia

                        </button>

                    </div>

                </form>

            </div>



            <!-- TABLA -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h2 class="text-lg font-semibold text-gray-700">
                        Lista de materias registradas
                    </h2>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                            <tr>

                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Clave</th>
                                <th class="px-6 py-3 text-center">Acciones</th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            @foreach ($materias as $materia)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $materia->id }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $materia->nombre }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $materia->clave }}
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-3">

                                            <!-- EDITAR -->
                                            <a href="{{ route('admin.materias.edit', $materia->id) }}"
                                                class="bg-yellow-400 text-white px-3 py-1.5 rounded-md text-sm
                                        hover:bg-yellow-500 transition">

                                                Editar

                                            </a>


                                            <!-- ELIMINAR -->
                                            <button
                                                onclick="abrirModalEliminar(
                                                '{{ route('admin.materias.delete', $materia->id) }}',
                                                'la materia {{ $materia->nombre }}',
                                                'Esto también eliminará horarios, grupos, inscripciones y calificaciones relacionadas.'
                                                )"
                                                class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-red-600">
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

                            @foreach ($materias->getUrlRange(1, $materias->lastPage()) as $page => $url)
                                @if ($page == $materias->currentPage())
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

    </div>
@endsection
