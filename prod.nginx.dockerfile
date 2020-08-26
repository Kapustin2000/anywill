FROM nginx:1.15-alpine

COPY ./prod.conf /etc/nginx/conf.d/nginx.conf
COPY ./resources/ssl/crm.anywill.coelix.online /etc/nginx/certs

COPY ./public /var/www/public
