@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-xl mx-auto">

            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Editar Materia
            </h1>

            <div class="bg-white rounded-lg shadow p-6">

                <form action="{{ route('admin.materias.update', $materia->id) }}" method="POST" class="space-y-5">

                    @csrf
                    @method('PUT')

                    <!-- NOMBRE -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Nombre de la materia
                        </label>

                        <input type="text" name="nombre" value="{{ $materia->nombre }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />

                    </div>


                    <!-- CLAVE -->

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Clave de la materia
                        </label>

                        <input type="text" name="clave" value="{{ $materia->clave }}" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />

                    </div>


                    <!-- BOTONES -->

                    <div class="flex justify-end gap-3 pt-2">

                        <a href="{{ route('admin.materias') }}"
                            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">

                            Cancelar

                        </a>

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">

                            Guardar cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
