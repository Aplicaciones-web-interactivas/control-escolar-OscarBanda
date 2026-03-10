@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-5xl mx-auto">

            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                Gestión de Materias
            </h1>

            <!-- FORMULARIO -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-10 border border-gray-100">

                <h2 class="text-xl font-semibold text-gray-700 mb-4">
                    Agregar nueva materia
                </h2>

                <form action="{{ route('admin.materias.save') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">

                    @csrf

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Nombre</label>

                        <input type="text" name="nombre" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" />

                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Clave</label>

                        <input type="text" name="clave" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" />

                    </div>

                    <div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg shadow hover:bg-blue-700 hover:shadow-md transition">
                            Agregar Materia
                        </button>

                    </div>

                </form>

            </div>


            <!-- TABLA -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-100">

                    <h2 class="text-xl font-semibold text-gray-700">
                        Lista de Materias
                    </h2>

                </div>

                <table class="w-full text-left">

                    <thead class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">

                        <tr>

                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Clave</th>
                            <th class="px-6 py-3">Acciones</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

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

                                <td class="px-6 py-4 flex gap-2">

                                    <a href="{{ route('admin.materias.edit', $materia->id) }}"
                                        class="bg-amber-400 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-amber-500 transition">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.materias.delete', $materia->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm font-medium hover:bg-red-600 transition">
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

    </div>
@endsection
