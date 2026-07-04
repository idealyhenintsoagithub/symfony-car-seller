FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/symfony/public

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        libxml2-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libpq-dev \
        default-mysql-client \
        nodejs \
        npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql intl zip opcache gd \
    && a2enmod rewrite headers \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN sed -i "s#/var/www/html#${APACHE_DOCUMENT_ROOT}#g" /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/symfony

COPY . .

COPY composer.json composer.lock ./
# COPY package.json package-lock.json ./
RUN npm install --global yarn@1
RUN composer install
RUN yarn install

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data var public config \
    && composer dump-env dev \
    && php bin/console cache:clear \
    && npm run build

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
