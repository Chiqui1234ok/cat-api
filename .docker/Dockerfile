# Usamos una imagen base de PHP con FPM y la extensión PDO para MySQL
FROM php:8.2-fpm

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Crear el proyecto Laravel si no existe composer.json
RUN if [ ! -f /var/www/html/composer.json ]; then \
        composer create-project --prefer-dist laravel/laravel .; \
    fi

# Dar permisos al directorio de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 9000 para el contenedor PHP-FPM
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]