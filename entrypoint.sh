#!/bin/bash

set -e

echo "Разворачиваем микросервис products"

docker compose exec products bash -c "
  cp .env.example .env &&
  composer install &&
  php artisan storage:link &&
  chmod 777 -R ./storage &&
  chmod 777 -R ./bootstrap/cache &&
  php artisan migrate
"

echo "Разворачиваем микросервис users"

docker compose exec users bash -c "
  cp .env.example .env &&
  composer install &&
  php artisan storage:link &&
  chmod 777 -R ./storage &&
  chmod 777 -R ./bootstrap/cache &&
  php artisan migrate
"

echo "Разворачиваем микросервис notifications"

docker compose exec notifications bash -c "
  cp .env.example .env &&
  composer install &&
  php artisan storage:link &&
  chmod 777 -R ./storage &&
  chmod 777 -R ./bootstrap/cache
"