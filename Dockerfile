FROM php:8.2-fpm-alpine

# Instalar las dependencias necesarias
RUN apk --no-cache add \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql
