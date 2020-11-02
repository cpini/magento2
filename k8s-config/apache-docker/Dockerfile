ARG APACHE_VERSION="2.4.32"
FROM httpd:${APACHE_VERSION:+${APACHE_VERSION}-}alpine
LABEL maintainer="Cristian Pini"
ENV TZ=Europe/London
RUN apk update; \
    apk upgrade; \
    apk add --no-cache tzdata; 
#COPY /usr/share/zoneinfo/$TZ /etc/localtime 
#RUN echo $TZ > /etc/timezone;

ARG WEB_SSL_KEY
ARG WEB_SSL_CRT
ARG WEB_SSL_PEM

RUN mkdir -p /usr/local/apache2/conf/ssl-certs
# Copy apache vhost file to proxy php requests to php-fpm container
COPY k8s-config/apache-docker/magento.apache.conf /usr/local/apache2/conf/magento.apache.conf
RUN echo "Include /usr/local/apache2/conf/magento.apache.conf" >> /usr/local/apache2/conf/httpd.conf \
&& echo "${WEB_SSL_KEY}" > /usr/local/apache2/conf/ssl-certs/test.txt;
#&& echo "${WEB_SSL_CRT}" > /usr/local/apache2/conf/ssl-certs/mage.xyz.key \
#&& echo "${WEB_SSL_PEM}" > /usr/local/apache2/conf/ssl-certs/myCA.pem;
