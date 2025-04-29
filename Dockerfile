# Deploy stage
FROM php:8.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev libicu-dev libonig-dev libxml2-dev \
    g++ make autoconf pkg-config zip unzip \
    && docker-php-ext-install pdo pdo_mysql intl mbstring zip

# Enable mod_rewrite
RUN a2enmod rewrite

# Change the default document root of the server
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Add necessary rules for .htaccess overrides
RUN echo '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy only composer files and install dependencies first (for better layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application files needed for production
COPY --chown=www-data:www-data config/ config/
COPY --chown=www-data:www-data data/ data/
COPY --chown=www-data:www-data public/ public/
COPY --chown=www-data:www-data secrets/ secrets/
COPY --chown=www-data:www-data src/ src/
COPY --chown=www-data:www-data scripts/ scripts/
COPY --chown=www-data:www-data migrations/ migrations/

# Expose Apache port
EXPOSE 80

# Security best practice
USER www-data

# Use the default Apache start command (from base image)
CMD ["apache2-foreground"]
