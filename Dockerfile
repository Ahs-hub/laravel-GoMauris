FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip curl git \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app source code
COPY . .

# Copy composer from separate image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set Laravel storage permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Set the Apache document root to Laravel's /public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
