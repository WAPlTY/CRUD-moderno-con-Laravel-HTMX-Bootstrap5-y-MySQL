# CRUD Moderno con Laravel, HTMX y Bootstrap 5 🚀

Aplicación CRUD completa para gestión de empleados utilizando las últimas tecnologías web. Implementa operaciones sin recarga de página gracias a HTMX y un diseño responsive con Bootstrap 5.

![CRUD Moderno con Laravel, HTMX y Bootstrap 5](https://raw.githubusercontent.com/urian121/imagenes-proyectos-github/refs/heads/master/CRUD-Moderno-con-Laravel-HTMX-Bootstrap5-y-MySQL.gif)

## ✨ Características

- **Laravel** - Framework PHP moderno
- **HTMX** - Interacciones dinámicas sin JavaScript complejo
- **Bootstrap 5** - UI responsive y moderna
- **MySQL** - Base de datos relacional
- **Modales dinámicas** - Para crear, editar y ver detalles
- **Subida de archivos** - Gestión de avatares de empleados

## 🛠️ Requisitos

- PHP 8.2+
- Composer
- MySQL
- Servidor web (Apache/Nginx)

## 🚀 Instalación

1. **Clonar el repositorio**
   ```bash
   git clone [https://github.com/urian121/CRUD-moderno-con-Laravel-HTMX-Bootstrap5-y-MySQL.git]
   cd CRUD-moderno-con-Laravel-HTMX-Bootstrap5-y-MySQL
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurar base de datos**
   - Crear base de datos MySQL
   - Actualizar credenciales en `.env`

5. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

6. **Iniciar servidor**
   ```bash
   php artisan serve
   ```

## 🎯 Funcionalidades

### CRUD Completo
- ✅ **Crear** empleados con modal dinámica
- ✅ **Leer** lista de empleados con paginación
- ✅ **Actualizar** datos mediante modal de edición
- ✅ **Eliminar** con confirmación en modal

### Características Técnicas
- 🔄 **Sin recargas de página** - Todas las operaciones usan HTMX
- 📱 **Responsive** - Diseño adaptable a todos los dispositivos
- 🖼️ **Gestión de avatares** - Subida y visualización de imágenes
- ⚡ **Navegación rápida** - Interfaz fluida y moderna
- 🎨 **Bootstrap 5** - Componentes y estilos modernos

## 📁 Estructura del Proyecto

```
app/
├── Http/Controllers/EmpleadosController.php
├── Models/Empleados.php
resources/views/
├── layouts/app.blade.php
├── empleados/
│   ├── index.blade.php
│   ├── add.blade.php
│   ├── edit.blade.php
│   └── table-rows.blade.php
└── modals/
    ├── empleado-show-modal.blade.php
    ├── empleado-edit-modal.blade.php
    └── confirm-delete-modal.blade.php
public/js/modal-handler.js
```

## 🚀 Uso

1. Accede a `http://localhost:8000`
2. Usa el botón "Agregar Empleado" para crear registros
3. Haz clic en "Ver" para mostrar detalles en modal
4. Usa "Editar" para modificar datos existentes
5. "Eliminar" muestra confirmación antes de borrar


*Proyecto desarrollado con las mejores prácticas de desarrollo web moderno* 🚀
