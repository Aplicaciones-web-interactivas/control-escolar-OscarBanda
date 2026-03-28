<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-sm space-y-4">

        <!-- MENSAJES -->

        @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm text-center">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm text-center">
            {{ session('error') }}
        </div>
        @endif


        <!-- FORMULARIO -->

        <form method="POST" action="/login"
            class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-5">

            @csrf

            <div class="text-center">

                <h2 class="text-2xl font-bold text-gray-800">
                    Iniciar sesión
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Accede con tu cuenta institucional
                </p>

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


            <!-- BOTON -->

            <button
                class="w-full bg-blue-600 text-white py-2 rounded-lg
                hover:bg-blue-700 transition font-medium">

                Entrar

            </button>


            <!-- REGISTER -->

            <div class="text-center pt-2">

                <a href="/register"
                    class="text-sm text-blue-600 hover:underline">

                    ¿No tienes cuenta? Registrarse

                </a>

            </div>

        </form>

    </div>

</body>

</html>