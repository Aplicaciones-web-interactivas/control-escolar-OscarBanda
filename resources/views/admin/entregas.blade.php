@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- TITULO -->
    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            Entregas
        </h1>

        <p class="text-gray-500 text-sm mt-1">
            Archivos enviados por los alumnos
        </p>

    </div>


    <!-- TABLA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-200">

            <h2 class="text-lg font-semibold text-gray-700">
                Lista de entregas
            </h2>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">

                    <tr>

                        <th class="px-6 py-3 text-left">
                            Alumno
                        </th>

                        <th class="px-6 py-3 text-left">
                            Grupo
                        </th>

                        <th class="px-6 py-3 text-left">
                            Materia
                        </th>

                        <th class="px-6 py-3 text-center">
                            Archivo
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200">

                    @foreach ($entregas as $entrega)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $entrega->alumno->nombre }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $entrega->tarea->grupo->nombre }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $entrega->tarea->grupo->horario->materia->nombre }}
                            </td>

                            <td class="px-6 py-4 text-center">

                                <a href="/entregas/{{ $entrega->archivo_pdf }}"
                                   target="_blank"
                                   class="bg-blue-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-blue-600 transition">

                                    Ver PDF

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