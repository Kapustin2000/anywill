FROM nginx:1.15-alpine

COPY ./prod.conf /etc/nginx/conf.d/nginx.conf
# COPY ./resources/ssl/api.smart-dev.co.uk /etc/nginx/certs

COPY ./public /var/www/public
