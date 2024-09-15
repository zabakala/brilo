#!/bin/sh

php -v
composer install

symfony console --no-interaction doctrine:migration:migrate
symfony console --no-interaction doctrine:fixtures:load
