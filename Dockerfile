# Use a multi-stage build for a smaller final image
# Development Stage
FROM php:8.1.0-apache AS builder

# Set working directory
WORKDIR /var/www/html

# Enable mod_rewrite
RUN a2enmod rewrite

# Install necessary libraries and tools
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    curl \
    nodejs \
    npm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy only the composer files first to leverage caching
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && composer dump-autoload --optimize \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && chmod -R 755 public \ 
    && chmod -R 755 public/icons
    

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Run npm install during the build
RUN npm ci 

# --no-cache

# Install Vite locally (if needed for development)
# RUN npm install vite --save-dev

# Build assets with Vite (if needed for development)
# RUN npx vite build

# Set up Apache configuration
RUN a2enmod rewrite

# Copy Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/

# Enable the configuration
RUN [ ! -e /etc/apache2/sites-enabled/000-default.conf ] && ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/ || true

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/setup.sh

# PHP Extension
RUN docker-php-ext-install gettext intl pdo_mysql gd

# Configure GD extension
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# RUN php artisan migrate

# RUN php artisan db:seed

# Expose port 80 for Apache
EXPOSE 80

# Command to start Apache when the container starts
CMD ["apache2-foreground"]  
