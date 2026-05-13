# Use an official PHP image with Apache
FROM php:8.2-apache

# Install the MySQL extension for PHP
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your website files into the container
# This puts your index.html, brain.php, etc. into the web server directory
COPY . /var/www/html/

# Set permissions so Apache can read the files
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to the outside world
EXPOSE 80