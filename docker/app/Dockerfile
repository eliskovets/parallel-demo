FROM php:7.2-alpine

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

VOLUME /app
WORKDIR /app

CMD composer install && php index.php