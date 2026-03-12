@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-800 mb-8">
            Dashboard
        </h1>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">

            <h2 class="text-xl font-semibold text-gray-700 mb-4">
                Información del usuario
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="text-sm text-gray-500">Nombre</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ $user->nombre }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="text-sm text-gray-500">Clave institucional</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ $user->clave_institucional }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="text-sm text-gray-500">Rol</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ $user->role }}
                    </p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border">
                    <p class="text-sm text-gray-500">Estado</p>
                    <p class="text-lg font-medium text-gray-800">
                        {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection