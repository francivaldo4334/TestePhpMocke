FROM php:8.3-cli

# Instalar extensões necessárias (PDO e PostgreSQL)
RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

# Copiar dependências, se tiver composer.json
COPY . .

# Instalar o Composer, se necessário
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
