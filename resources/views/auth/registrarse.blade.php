<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm space-y-4">

        <!-- MENSAJE -->

        @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm text-center">
            {{ session('success') }}
        </div>
        @endif


        <!-- FORMULARIO -->

        <form method="POST" action="/register"
            class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-5">

            @csrf

            <div class="text-center">

                <h2 class="text-2xl font-bold text-gray-800">
                    Crear cuenta
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Regístrate para acceder al sistema
                </p>

            </div>


            <!-- NOMBRE -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Nombre
                </label>

                <input
                    type="text"
                    name="nombre"
                    required
                    placeholder="Nombre completo"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- CLAVE -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Clave institucional
                </label>

                <input
                    type="text"
                    name="clave_institucional"
                    required
                    placeholder="Ej. A12345"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- PASSWORD -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Contraseña
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

            </div>


            <!-- ROL -->

            <div>

                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Rol
                </label>

                <select
                    name="role"
                    required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">
                        Seleccionar rol
                    </option>

                    <option value="Estudiante">
                        Estudiante
                    </option>

                    <option value="Profesor">
                        Profesor
                    </option>

                    <option value="Administrador">
                        Administrador
                    </option>

                </select>

            </div>


            <!-- BOTON -->

            <button
                class="w-full bg-green-600 text-white py-2 rounded-lg
                hover:bg-green-700 transition font-medium">

                Registrarse

            </button>


            <!-- LOGIN -->

            <div class="text-center pt-2">

                <a href="/login"
                    class="text-sm text-blue-600 hover:underline">

                    Volver al login

                </a>

            </div>

        </form>

    </div>

</body>

</html>