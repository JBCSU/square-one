FROM moderntribe/wordpress:nginx-php7-fpm

RUN apk add --update nodejs nodejs-npm && npm install npm@latest -g
RUN npm install -g grunt-cli

COPY ./ /srv/site
RUN chown -R nginx:nginx /srv/site
RUN cd /srv/site && \
    git submodule update --init && \
    npm set progress=false && \
    npm install && \
    grunt