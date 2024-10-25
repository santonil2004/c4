FROM php:8.3-fpm-alpine

# Install dependencies and PHP extensions
RUN apk add --no-cache \
    icu-dev \
    && docker-php-ext-install intl mysqli pdo pdo_mysql

# No need for explicit cleanup in Alpine as --no-cache does this automatically
