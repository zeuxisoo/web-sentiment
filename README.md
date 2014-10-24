# Web-Sentiment

A poor application to no choice is a choice

## Installation

Composer

    curl -sS https://getcomposer.org/installer | php

Vendors

    php composer.phar install

Database

    touch app/database/production.sqlite

Migrations

    php artisan migrate
    php artisan migrate --package=rtconner/laravel-tagging
