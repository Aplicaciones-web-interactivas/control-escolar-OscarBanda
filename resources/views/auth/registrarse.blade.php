<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-80">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mb-3 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/register" class="bg-white p-6 rounded shadow">

            @csrf

            <h2 class="text-xl mb-4 text-center">Crear cuenta</h2>

            <input type="text" name="nombre" placeholder="Nombre" class="w-full border p-2 mb-3" required>

            <input type="text" name="clave_institucional" placeholder="Clave institucional"
                class="w-full border p-2 mb-3" required>

            <input type="password" name="password" placeholder="Contraseña" class="w-full border p-2 mb-3" required>

            <button class="bg-green-500 text-white w-full p-2 rounded">
                Registrarse
            </button>

            <div class="text-center mt-4">

                <a href="/login" class="text-blue-500 hover:underline text-sm">
                    Volver al login
                </a>

            </div>

        </form>

    </div>

</body>

</html>


