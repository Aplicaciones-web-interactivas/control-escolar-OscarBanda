@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto space-y-8">

        <!-- TITULO -->
        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Editar Materia
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Modifica la información de la materia seleccionada
            </p>

        </div>


        <!-- CARD FORMULARIO -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

            <form action="{{ route('admin.materias.update', $materia->id) }}"
                  method="POST"
                  class="space-y-6">

                @csrf
                @method('PUT')


                <!-- NOMBRE -->

                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Nombre de la materia
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ $materia->nombre }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        outline-none transition">

                </div>


                <!-- CLAVE -->

                <div>

                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Clave de la materia
                    </label>

                    <input
                        type="text"
                        name="clave"
                        value="{{ $materia->clave }}"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        outline-none transition">

                </div>


                <!-- BOTONES -->

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">

                    <a
                        href="{{ route('admin.materias') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-gray-200 text-gray-700
                        hover:bg-gray-300 transition">

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-medium
                        bg-blue-600 text-white
                        hover:bg-blue-700 transition">

                        Guardar cambios

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection