@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-xl mx-auto">

            <h1 class="text-3xl font-bold text-gray-800 mb-8">
                Editar Materia
            </h1>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">

                <form action="{{ route('admin.materias.update', $materia->id) }}" method="POST" class="space-y-5">

                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Nombre
                        </label>

                        <input type="text" name="nombre" value="{{ $materia->nombre }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" />

                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Clave
                        </label>

                        <input type="text" name="clave" value="{{ $materia->clave }}" required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition" />

                    </div>

                    <div class="flex gap-3 pt-2">

                        <button type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            Actualizar
                        </button>

                        <a href="{{ route('admin.materias') }}"
                            class="bg-gray-400 text-white px-5 py-2 rounded-lg hover:bg-gray-500 transition">
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
