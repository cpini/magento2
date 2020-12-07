ARG PHP_VERSION="7.4.13"
ARG TAG_NAME_ARG="latest"
ENV BUILD_VERSION=${TAG_NAME_ARG}
FROM php:${PHP_VERSION:+${PHP_VERSION}-}fpm-alpine
LABEL maintainer="Cristian Pini"
ENV TZ=Europe/London
RUN apk update; \
apk upgrade; \
apk add --no-cache fcgi tzdata freetype freetype-dev libxslt-dev libpng libjpeg libxml2-dev zlib libwebp-dev libpng-dev jpeg-dev icu-dev zlib-dev libzip-dev; \
apk add --no-cache $PHPIZE_DEPS; \
docker-php-ext-configure gd --with-jpeg \
                                --with-webp \
                                --with-freetype \
&& docker-php-ext-configure zip \
&& docker-php-ext-install mysqli bcmath gd pdo_mysql soap xsl zip intl opcache sockets \
&& echo "memory_limit=2G" > /usr/local/etc/php/conf.d/memory-limit.ini \
&& echo "max_input_vars=1000" > /usr/local/etc/php/conf.d/max-input-vars-php.ini \
&& echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer --version=1.10.16 \
&& php -r "unlink('composer-setup.php');" \
&& rm -rf /var/cache/* /tmp/* /var/tmp/*
## copy the fpm config over
COPY k8s-config/php-docker/fpm-www.conf /usr/local/etc/php-fpm.d/www.conf
COPY k8s-config/php-docker/php-fpm-healthcheck /usr/local/bin/
COPY --chown=www-data . /var/www/html
USER www-data
RUN cd /var/www/html \
#&& echo "${TAG_NAME_ARG}" > ./build_version.txt \
&& cp .htaccess pub/ \
&& mv pub pub.release \
&& composer install --no-cache --no-dev