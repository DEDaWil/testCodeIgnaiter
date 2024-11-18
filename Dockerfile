# Базовый образ PHP
FROM php:8.1-cli

# Установка зависимостей для intl, pdo_mysql и Composer
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_mysql mysqli \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование исходников проекта в контейнер
COPY . /var/www/html/

# Установка рабочего каталога
WORKDIR /var/www/html

# Открытие порта
EXPOSE 8080
