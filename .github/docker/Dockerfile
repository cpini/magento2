ARG PHP_VERSION="7.3.17"
FROM php:${PHP_VERSION:+${PHP_VERSION}-}fpm-alpine
LABEL maintainer="Cristian Pini"
ENV TZ=Europe/London
RUN apk update; \
    apk upgrade; \
    apk add --no-cache tzdata freetype freetype-dev libxslt-dev libpng libjpeg libxml2-dev zlib libwebp-dev libpng-dev jpeg-dev icu-dev zlib-dev libzip-dev; \
    apk add --no-cache $PHPIZE_DEPS; 
RUN docker-php-ext-configure gd --with-png-dir=/usr/include/ \
                                   --with-jpeg-dir=/usr/include/ \
                                   --with-webp-dir=/usr/include/ \
                                   --with-freetype-dir=/usr/inlcude/ \
 && docker-php-ext-configure zip --with-libzip \
 && docker-php-ext-install mysqli bcmath gd pdo_mysql soap xsl zip intl opcache  \
 && echo "memory_limit=2G" > /usr/local/etc/php/conf.d/memory-limit.ini \
 && echo "max_input_vars=1000" > /usr/local/etc/php/conf.d/max-input-vars-php.ini \
 && curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer 
COPY . .
#RUN composer install
#RUN file="$(ls -1 ./teststuff.txt)" && echo $file
#ENTRYPOINT ["sh", "-c", "./vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist"]
ENTRYPOINT ["sh", "-c", "sh run-qa.sh"]