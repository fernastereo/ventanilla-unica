# FROM php:8.2-fpm-alpine

#RUN docker-php-ext-install pdo pdo_mysql

FROM php:8.2-fpm

# Instala las extensiones necesarias y otras herramientas
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd \
    && pecl install xdebug && docker-php-ext-enable xdebug

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
