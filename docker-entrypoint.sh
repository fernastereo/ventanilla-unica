#!/bin/bash

# Crear directorios si no existen
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/bootstrap/cache

# Establecer permisos
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chown -R laravel:www-data /var/www/html/storage
chown -R laravel:www-data /var/www/html/bootstrap/cache

# Ejecutar el comando proporcionado
exec "$@"