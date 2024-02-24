# Usar una imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar el módulo de Apache mod_rewrite
RUN a2enmod rewrite

# Actualizar la lista de paquetes e instalar dependencias
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html/

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Cambiar los permisos para el directorio storage de Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Instalar las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install

# Copiar el archivo de configuración de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache al arrancar el contenedor
CMD ["apache2-foreground"]
