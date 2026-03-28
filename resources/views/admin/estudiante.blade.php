@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Tareas
</h1>

<div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">

            <tr>

                <th class="px-6 py-3 text-left">
                    Tarea
                </th>

                <th class="px-6 py-3 text-left">
                    Descripción
                </th>

                <th class="px-6 py-3 text-left">
                    Fecha de entrega
                </th>

                <th class="px-6 py-3 text-center">
                    Entrega
                </th>

            </tr>

        </thead>

        <tbody class="divide-y divide-gray-200">

            @foreach ($tareas as $tarea)

                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $tarea->titulo }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $tarea->descripcion }}
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        {{ $tarea->fecha_entrega }}
                    </td>

                    <td class="px-6 py-4">

                        <form action="{{ route('tareas.entregar') }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              class="flex items-center justify-center gap-3">

                            @csrf

                            <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">

                            <input type="file" 
                                   name="archivo" 
                                   accept="application/pdf"
                                   class="text-sm border rounded p-1"
                                   required>

                            <button class="bg-green-500 text-white px-3 py-1.5 rounded-md hover:bg-green-600 transition">

                                Subir

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection