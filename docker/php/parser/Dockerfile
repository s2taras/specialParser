FROM php:7.4-cli AS prod
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./parser /var/www/parser
WORKDIR /var/www/parser

RUN composer install


FROM prod AS dev
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./docker/php/parser/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini