FROM php:8.0-fpm-alpine

# RUN apk add doas; \
#     adduser tommypria -G wheel; \
#     echo 'tommypria:123' | chpasswd; \
#     echo 'permit :wheel as root' > /etc/doas.d/doas.conf

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
    git \
    bash

RUN docker-php-ext-install intl bcmath pdo pdo_mysql zip exif pcntl gd opcache

RUN pecl install mongodb xdebug

RUN docker-php-ext-enable mongodb xdebug 

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN curl -O https://getcomposer.org/download/2.3.10/composer.phar \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

RUN apk add --update sudo

ARG USER=tommypria

RUN  adduser -D $USER \
    && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
    && chmod 0440 /etc/sudoers.d/$USER

USER $USER

WORKDIR /var/www/html