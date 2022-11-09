FROM php:8.0-fpm-alpine

WORKDIR /var/www/html

RUN apk upgrade --update && apk add \
    alpine-sdk \
    openssl \
    zip \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    icu-dev \
    autoconf \
    pkgconf \
    libressl-dev \
    bash

RUN docker-php-ext-install intl bcmath pdo pdo_mysql zip exif pcntl gd opcache

RUN pecl install mongodb xdebug

RUN docker-php-ext-enable mongodb xdebug 

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN curl -O https://getcomposer.org/download/2.3.10/composer.phar \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

RUN chown -R 1000:1000 /var/www/html

USER 1000