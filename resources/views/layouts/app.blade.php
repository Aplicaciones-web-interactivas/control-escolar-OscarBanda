<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi sistema</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow">

        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">

            <div class="font-bold text-lg">
                <a href="/dashboard" class="cursor-pointer">
                    Sistema Escolar
                </a>
            </div>

            <!-- Menu -->
            <div class="flex gap-6 items-center">

                <a href="{{ route('admin.materias') }}" class="hover:underline">
                    Materias
                </a>

                <a href="{{  route('admin.horarios') }}" class="hover:underline">
                    Horarios
                </a>

                <a href="{{ route('admin.grupos') }}" class="hover:underline">
                    Grupos
                </a>

                <a href="{{ route('admin.inscripciones') }}" class="hover:underline">
                    Inscripciones
                </a>

                <a href="#" class="hover:underline">
                    Calificaciones
                </a>

                <!-- Logout -->
                <form method="POST" action="/logout">
                    @csrf
                    <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>

    </nav>

    <!-- CONTENIDO -->
    <div class="max-w-6xl mx-auto mt-6">

        @yield('content')

    </div>

</body>

</html>