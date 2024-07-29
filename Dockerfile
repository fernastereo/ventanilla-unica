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

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia el archivo composer.json y composer.lock si existe
COPY ./ventanilla-unica-api/composer.json ./ventanilla-unica-api/composer.lock* /var/www/html/

# Establece la variable de entorno para Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Verifica si los archivos están presentes
RUN ls -la /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-interaction --optimize-autoloader

# Copia el resto de los archivos del proyecto
COPY ./ventanilla-unica-api /var/www/html

# Cambia el propietario de los archivos
RUN chown -R www-data:www-data /var/www

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Ejecuta PHP-FPM en el primer plano
CMD ["php-fpm"]
