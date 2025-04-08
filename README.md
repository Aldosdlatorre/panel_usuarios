# Panel de Usuarios en Laravel

## Requisitos
- PHP 8.0+
- Composer
- MySQL/MariaDB

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

2. Instalar dependencias:
```bash
composer install
npm install
```

3. Configurar entorno:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurar base de datos en `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

5. Migrar base de datos:
```bash
php artisan migrate --seed
```

6. Iniciar servidor:
```bash
php artisan serve
```

## Características principales
- CRUD completo de usuarios
- Validaciones de formulario
- Mensajes flash temporales