<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema Escolar</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">

            <!-- LOGO -->
            <div class="p-6 border-b border-gray-200">

                <a href="/dashboard" class="text-xl font-bold text-blue-600">
                    Sistema Escolar
                </a>

            </div>

            <!-- MENU -->
            <nav class="p-4 space-y-2">

                <a href="/dashboard" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700 font-medium">
                    Inicio
                </a>

                <a href="{{ route('admin.materias') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    Materias
                </a>

                <a href="{{ route('admin.horarios') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    Horarios
                </a>

                <a href="{{ route('admin.grupos') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    Grupos
                </a>

                <a href="{{ route('admin.inscripciones') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    Inscripciones
                </a>

                <a href="{{ route('admin.calificaciones') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
                    Calificaciones
                </a>

            </nav>

        </aside>


        <!-- CONTENIDO -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white border-b border-gray-200 shadow-sm">

                <div class="flex justify-between items-center px-8 py-4">

                    <h2 class="text-lg font-semibold text-gray-700">
                        Panel Administrativo
                    </h2>

                    <!-- USER -->
                    <div class="flex items-center gap-4">

                        <span class="text-sm text-gray-600">
                            {{ Auth::user()->nombre }}
                        </span>

                        <form method="POST" action="/logout">
                            @csrf

                            <button
                                class="bg-red-500 text-white px-3 py-1.5 rounded-md text-sm hover:bg-red-600 transition">
                                Cerrar sesión
                            </button>

                        </form>

                    </div>

                </div>

            </header>


            <!-- PAGE CONTENT -->
            <main class="flex-1 p-8">

                @yield('content')

            </main>

        </div>

    </div>

    <!-- MODAL GLOBAL ELIMINAR -->
    <div id="modalEliminar" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-lg w-96 p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-3">
                Confirmar eliminación
            </h2>

            <p class="text-gray-600 mb-4">
                ¿Seguro que deseas eliminar
                <span id="modalObjeto" class="font-semibold"></span>?
            </p>

            <p id="modalAdvertencia" class="text-sm text-red-500 mb-6 hidden">
            </p>

            <div class="flex justify-end gap-3">

                <button onclick="cerrarModalEliminar()" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">

                    Cancelar

                </button>

                <form id="formEliminarGlobal" method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">

                        Eliminar

                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>
        function abrirModalEliminar(url, nombre, advertencia = null) {

            document.getElementById("modalEliminar").classList.remove("hidden");
            document.getElementById("modalEliminar").classList.add("flex");

            document.getElementById("modalObjeto").textContent = nombre;

            document.getElementById("formEliminarGlobal").action = url;

            let aviso = document.getElementById("modalAdvertencia");

            if (advertencia) {
                aviso.textContent = advertencia;
                aviso.classList.remove("hidden");
            } else {
                aviso.classList.add("hidden");
            }
        }

        function cerrarModalEliminar() {

            const modal = document.getElementById("modalEliminar");

            modal.classList.remove("flex");
            modal.classList.add("hidden");

        }
    </script>

</body>

</html>
