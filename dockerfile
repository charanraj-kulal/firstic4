FROM php:7.4-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy CI4 project files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html