FROM composer:2 AS composer_deps

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader \
    --no-scripts


FROM node:20-alpine AS frontend_build

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci --include=dev --no-audit --no-fund --cache /tmp/.npm

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build


FROM php:8.4-cli-alpine AS runtime

WORKDIR /app

RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        intl \
        zip \
        gd \
        pdo \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath

COPY . .
COPY --from=composer_deps /app/vendor ./vendor
COPY --from=frontend_build /app/public/build ./public/build

RUN APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA= php artisan package:discover --ansi \
    && APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA= php artisan filament:upgrade --ansi

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data

ENV APP_ENV=production
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

EXPOSE 8080

CMD ["sh", "-lc", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]

