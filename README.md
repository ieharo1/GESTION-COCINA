# 🍽️ Gestión de Cocina / Recetario Profesional

Sistema completo para la gestión de recetas y cocina profesional.

---

## 📝 Descripción

Plataforma profesional para la administración de recetas y cocina. Gestiona recetas, ingredientes, categorías, menús y planificación semanal.

### ¿Qué hace este proyecto?

- **Gestión de Recetas**: Crear recetas con ingredientes, pasos, tiempo de preparación
- **Gestión de Ingredientes**: Catálogo de ingredientes
- **Categorías**: Organización por categorías
- **Menús**: Creación de menús
- **Planificación Semanal**: Planificador de comidas semanal
- **Fotos de Platos**: Subida de imágenes
- **Cálculo de Porciones**: Adaptación de recetas
- **Dashboard**: Recetas populares, ingredientes más usados

---

## ✨ Características Principales

| Característica | Descripción |
|----------------|-------------|
| 📝 **Gestión de Recetas** | Crear con ingredientes y pasos |
| 🥬 **Ingredientes** | Catálogo completo |
| 📂 **Categorías** | Organización por tipo |
| 📋 **Menús** | Creación de menús |
| 📅 **Planificación** | Planificador semanal |
| 🖼️ **Fotos** | Subida de fotos de platos |
| 🔢 **Porciones** | Cálculo de porciones |
| 📊 **Dashboard** | Recetas populares, ingredientes |

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.3, Laravel 11, Livewire 3
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript Vanilla
- **Base de datos**: MySQL/MariaDB

---

## 🚀 Instalación y Uso

### Requisitos

- PHP 8.2+
- Composer
- MySQL/MariaDB

### Instalación

```bash
# Clonar el repositorio
git clone <repositorio>

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Poblar base de datos con datos de ejemplo
php artisan db:seed

# Iniciar servidor
php artisan serve
```

### Usar Docker

```bash
# Construir y levantar contenedores
docker compose up -d --build

# Ver estado de los contenedores
docker compose ps

# Acceder al contenedor
docker compose exec app bash

# Ejecutar migraciones dentro del contenedor
php artisan migrate

# Poblar base de datos
php artisan db:seed

# Ver logs
docker compose logs -f app
```

### Credenciales por defecto

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | admin@recetas.com | password |

---

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Livewire/           # Componentes Livewire
│   ├── Models/             # Modelos Eloquent
├── database/
│   ├── migrations/         # Migraciones
│   ├── seeders/            # Seeders
├── resources/views/        # Vistas Blade
├── docker-compose.yml      # Docker
└── Dockerfile              # Configuración Docker
```

---

## 📊 Módulos del Sistema

1. **Dashboard**: Recetas populares, ingredientes más usados
2. **Recetas**: CRUD con ingredientes, pasos, tiempo
3. **Ingredientes**: Catálogo completo
4. **Categorías**: Organización por tipo
5. **Menús**: Creación de menús
6. **Planificación**: Planificador semanal

---

## ⚠️ Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL 8.0 o MariaDB

---

## 📦 Paquetes Utilizados

- `laravel/framework` - Framework Laravel
- `livewire/livewire` - Componentes reactivos
- `bootstrap` - Framework CSS

---

## 👨‍💻 Desarrollado por Isaac Esteban Haro Torres

**Ingeniero en Sistemas · Full Stack · Automatización · Data**

- 📧 Email: zackharo1@gmail.com
- 📱 WhatsApp: 098805517
- 💻 GitHub: https://github.com/ieharo1
- 🌐 Portafolio: https://ieharo1.github.io/portafolio-isaac.haro/

---

© 2026 Isaac Esteban Haro Torres - Todos los derechos reservados.
