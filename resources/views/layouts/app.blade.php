<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desarrollo Full-Stack: CRUD Moderno con Laravel, HTMX, Bootstrap 5 y MySQL @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <h1 class="text-center fw-bold opacity-75">
        Desarrollo Full-Stack: 
    </h1>
    <h2 class="text-center fw-bold mb-4 opacity-75">
        CRUD Moderno con Laravel, HTMX, Bootstrap 5 y MySQL
    </h2>
    <!-- Modal Container -->
    <div class="modal_container"></div>
    
    <div class="container">        
        <div class="row justify-content-md-center">
            <div class="col-md-4" style="border-right: 1px solid #dee2e6;">
                <h1 class="text-center opacity-75">Registrar empleado <hr></h1>
                @include('empleados.add')
            </div>
           
            <div class="col-md-8" id="main-content">
                {{-- Si no hay contenido en la sección 'content', se incluirá la lista de empleados por defecto --}}
                @if (empty(trim($__env->yieldContent('content'))))
                <h1 class="text-center opacity-75">Lista de empleados <hr></h1>
                    @include('empleados.index')
                @else
                    @yield('content')
                @endif
            </div>
        </div>
    </div>


    <!-- Importar HTMX -->
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.6/dist/htmx.min.js" integrity="sha384-Akqfrbj/HpNVo8k11SXBb6TlBWmXXlYQrCSqEWmyKJe+hDm3Z/B2WVG4smwBkRVm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/nextjs-toast-notify@1.47.0/dist/nextjs-toast-notify.js"></script>
    <script>
        // Sistema simple de notificaciones para HTMX
        document.body.addEventListener('showAlert', function(evt) {
            // Recibe el mensaje dinámico desde el header HX-Trigger del controlador
            const message = evt.detail.value || 'Operación completada exitosamente.';
            // Muestra la notificación toast con el mensaje específico
            showToast.success(message, {
                duration: 5000,
                position: "top-right",
                transition: "bounceIn",
                icon: "",
                sound: true,
            });
        });
    </script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>