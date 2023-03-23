# Use an official PHP runtime as a parent image
FROM php:8-apache

# Set the working directory to /var/www/html/
WORKDIR /var/www/html/

# Copy the current directory contents into the container at /var/www/html/
COPY . .

# Install any needed packages
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
    apache2 \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    nano \
    vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql gd xml mbstring zip

# Enable mod_rewrite
RUN a2enmod rewrite

# Set up a custom Apache configuration file
COPY apache2.conf /etc/apache2/apache2.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

# Run Composer to install dependencies
RUN composer install

# Generate an application key
RUN php artisan key:generate

# Start Apache
CMD ["apache2-foreground"]