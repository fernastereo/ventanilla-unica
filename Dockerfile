FROM php:8.2-fpm-alpine

# RUN docker-php-ext-install pdo pdo_mysql
# RUN docker-php-ext-install pdo pdo_mysql mysqli pdo_pgsql pgsql

# Instalar las dependencias necesarias
RUN apk --no-cache add \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli pdo_pgsql pgsql
