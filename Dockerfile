# Escolher a imagem base do PHP com FPM
FROM php:8.2-fpm

# Instalar dependências para a extensão PDO_MYSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    openssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Copiar o código fonte para o contêiner
COPY . /var/www/html
