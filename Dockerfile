# Use official PHP with Apache
FROM php:8.2-apache

# Install mysqli extension for MySQL support
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite (optional, but often useful)
RUN a2enmod rewrite

# Copy project files into the container
COPY . /var/www/html/

# Set permissions (if needed)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
