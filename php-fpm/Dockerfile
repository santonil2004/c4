# Base image
FROM php:8.3.1-fpm

# Set environment variables
ENV PHP_INI_DIR="/usr/local/etc/php"

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
        $PHPIZE_DEPS \
        libicu-dev \
        libzip-dev \
        libxslt1-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        imagemagick \
        libmagickwand-dev \
        procps \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        intl \
        mysqli \
        pdo_mysql \
        opcache \
        xsl \
        zip \
    && pecl install \
        redis \
        imagick \
    && docker-php-ext-enable \
        redis \
        imagick \
    && apt-get purge -y --auto-remove $PHPIZE_DEPS \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && docker-php-source delete

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Copy custom PHP configuration
COPY ./php-fpm/php.ini $PHP_INI_DIR/conf.d/custom.ini

# Set working directory
WORKDIR /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Switch to non-root user
USER www-data

# Expose port and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]

# Health check for PHP-FPM
HEALTHCHECK --interval=30s --timeout=5s \
    CMD pidof php-fpm || exit 1
