FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    libxslt-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    imagemagick \
    imagemagick-dev \
    $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        intl \
        mysqli \
        pdo \
        pdo_mysql \
        opcache \
        xsl \
        zip

# Install PECL extensions
RUN pecl install \
        redis \
        imagick \
    && docker-php-ext-enable \
        redis \
        imagick

# Clean up
RUN apk del $PHPIZE_DEPS \
    && rm -rf /tmp/* /var/cache/apk/* /var/tmp/* \
    && docker-php-source delete

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy custom php.ini
COPY ./php-fpm/php.ini $PHP_INI_DIR/conf.d/custom.ini

# Set working directory
WORKDIR /var/www/html

# Copy your application files
COPY . /var/www/html

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress --prefer-dist

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data

# Expose port and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
