#!/bin/bash

set -e

# Set variables from docker.env
set -a && source code/docker.env && set +a

docker-compose down -v

docker-compose up --no-start --build

docker-compose run --rm php /bin/bash -c 'composer install'

docker-compose start

docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction