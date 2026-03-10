<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-80">

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 mb-3 rounded text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-3 mb-3 rounded text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login" class="bg-white p-6 rounded shadow">

            @csrf

            <h2 class="text-xl mb-4 text-center">Iniciar sesión</h2>

            <input type="text" name="clave_institucional" placeholder="Clave institucional"
                class="w-full border p-2 mb-3" required>

            <input type="password" name="password" placeholder="Contraseña" class="w-full border p-2 mb-3" required>

            <button class="bg-blue-500 text-white w-full p-2 rounded">
                Entrar
            </button>

        </form>

    </div>

</body>

</html>
