FROM dunglas/frankenphp:latest-php8.3-alpine

# Install PHP extensions required by Laravel
RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache

WORKDIR /app

# Copy application files
COPY . /app

# Set environment for production
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PORT=8080
ENV FRANKENPHP_CONFIG="web_server {
    listen :8080
}"

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8080

CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8080"]