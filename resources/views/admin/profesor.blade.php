@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- TITULO -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Tareas
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            Crear y administrar tareas para tus grupos
        </p>
    </div>


    <!-- CREAR TAREA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <h2 class="text-lg font-semibold text-gray-700 mb-6">
            Crear tarea
        </h2>

        <form action="{{ route('tareas.save') }}" method="POST" class="grid md:grid-cols-2 gap-6">

            @csrf

            <!-- TITULO -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Título
                </label>

                <input type="text"
                       name="titulo"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>


            <!-- GRUPO -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Grupo
                </label>

                <select name="grupo_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @foreach ($grupos as $grupo)

                        <option value="{{ $grupo->id }}">

                            {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }}

                        </option>

                    @endforeach

                </select>
            </div>


            <!-- DESCRIPCION -->
            <div class="md:col-span-2">

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Descripción
                </label>

                <textarea name="descripcion"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>

            </div>


            <!-- FECHA -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Fecha de entrega
                </label>

                <input type="date"
                    name="fecha_entrega"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>


            <!-- BOTON -->
            <div class="flex items-end">

                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg
                    hover:bg-blue-700 transition">

                    Crear tarea

                </button>

            </div>

        </form>

    </div>


    <!-- MIS TAREAS -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-700">
                Mis tareas
            </h2>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            Título
                        </th>

                        <th class="px-6 py-3 text-left">
                            Grupo
                        </th>

                        <th class="px-6 py-3 text-center">
                            Entregas
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200">

                    @foreach ($tareas as $tarea)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $tarea->titulo }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $tarea->grupo->nombre }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <a href="/tareas/{{ $tarea->id }}/entregas"
                                   class="bg-blue-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-blue-600">

                                    Ver entregas

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection