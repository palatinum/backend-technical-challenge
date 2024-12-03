FROM php:8.2-fpm
WORKDIR /var/www
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean
RUN chown -R www-data:www-data /var/www
