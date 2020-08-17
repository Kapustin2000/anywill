FROM php:7.2-fpm
 
RUN apt update && apt install -y \
  libpng-dev \
  libmcrypt-dev \
  zip \
  libxml2-dev \
  libmagickwand-dev \
  libicu-dev \
  libbz2-dev \
  libjpeg-dev \
  libmcrypt-dev \
  libreadline-dev \
  libfreetype6-dev \
  git \
  g++

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
  pdo_mysql \
  xml \
  zip \
  gd \
  mbstring \
  calendar \
  opcache \
  bcmath \
  iconv \
  intl \
  bz2 \
  soap \
  exif

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Что бы включить CACHE LEVEL
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock
COPY ./database/factories  ./database/factories
COPY ./database/seeds  ./database/seeds
COPY ./artisan  ./artisan

RUN composer install --prefer-dist --no-scripts --no-autoloader && rm -rf /root/.composer

COPY . .

RUN composer dump-autoload --no-scripts --optimize

# RUN php artisan optimize
# RUN php artisan config:clear
# RUN php artisan cache:clear

CMD php artisan migrate --force \
  && chown -R www-data:www-data storage
  && php artisan passport:install \
  && php-fpm
