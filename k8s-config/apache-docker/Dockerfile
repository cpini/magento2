ARG APACHE_VERSION="2.4.46"
FROM httpd:${APACHE_VERSION:+${APACHE_VERSION}-}alpine
LABEL maintainer="Cristian Pini"
ENV TZ=Europe/London
RUN apk update; \
    apk upgrade; \
    apk add --no-cache tzdata; 
#COPY /usr/share/zoneinfo/$TZ /etc/localtime 
#RUN echo $TZ > /etc/timezone;

RUN mkdir -p /usr/local/apache2/conf/ssl-certs
# Copy apache vhost file to proxy php requests to php-fpm container
COPY k8s-config/apache-docker/magento.apache.conf /usr/local/apache2/conf/magento.apache.conf
COPY ./decrypted-crt.txt /usr/local/apache2/conf/ssl-certs/mage.xyz.crt
COPY ./decrypted-key.txt /usr/local/apache2/conf/ssl-certs/mage.xyz.key
COPY ./decrypted-pem.txt /usr/local/apache2/conf/ssl-certs/myCA.pem
RUN echo "Include /usr/local/apache2/conf/magento.apache.conf" >> \
    /usr/local/apache2/conf/httpd.conf;