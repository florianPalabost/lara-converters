FROM php:8.3-fpm-alpine

LABEL maintainer="FP"

ENV UID=1000
ENV GID=1000
ENV USER=www
ENV GROUPNAME=$USER
ENV TZ=UTC

WORKDIR /var/www/html


# Setup utc timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS curl zip unzip git linux-headers sqlite libpq-dev postgresql-client oniguruma-dev zlib-dev libpng-dev libzip-dev

# Install necessary PHP extensions
RUN docker-php-ext-install bcmath exif mbstring gd opcache pgsql pdo_pgsql pdo zip \
 && pecl channel-update pecl.php.net && pecl install xdebug \
 && docker-php-ext-enable bcmath pdo pdo_pgsql mbstring exif gd xdebug

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
# from https://stackoverflow.com/questions/49955097/how-do-i-add-a-user-when-im-using-alpine-as-a-base-image
RUN addgroup \
    --gid "$GID" \
    "$GROUPNAME" \
&&  adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "$GROUPNAME" \
    --no-create-home \
    --uid "$UID" \
    $USER

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change current user to www
USER $USER

# TODO: use supervisor
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

