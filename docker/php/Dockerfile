FROM php:8.3-cli

WORKDIR /app

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        default-mysql-client \
    && docker-php-ext-install \
        pdo \ 
        pdo_mysql \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer