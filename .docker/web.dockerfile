FROM nginx:1.21
WORKDIR /var/www
COPY ./.docker/vhost.conf /etc/nginx/conf.d/default.conf
