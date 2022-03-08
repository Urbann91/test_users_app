# Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Uses light version of Laravel named Lumen.

## Install & start
**todo: move to makefile and use as single command**
- cp .env.example .env
- docker-compose build --build-arg UID=$(id -u) --build-arg GID=$(id -g)
- docker-compose up -d --force-recreate
- docker-compose run --rm app composer install
- docker-compose run --rm app php artisan migrate

## Stop service
- docker-compose down --rmi local --remove-orphans

## Revisions
The package spatie/laravel-activitylog is used. The activity_log table and trait LogsActivity are involved

## Init ide-helper
- ./usersapp ide-helper:generate

## Code-style PSR1 & PSR2 & PSR12
**installed squizlabs/php_codesniffer**
- docker-compose run --rm app vendor/bin/phpcs --ignore=*/vendor/* .
- docker-compose run --rm app vendor/bin/phpcbf --ignore=*/vendor/* .

## Use database connection in ide client
- jdbc:postgresql://localhost:7001/homestead

## How use it (via artisan CLI)
- ./usersapp user:get-all
- ./usersapp user:create --name=testname123 --email=testemail123@name.com --notes=notes
- ./usersapp user:find-by-id 1
- ./usersapp user:update 1 --email=testemail1234@name.com
- ./usersapp user:soft-delete-by-id 1

## Modify black lists
- add variable to .env BLACK_LIST_NAME=name1,name2
- add variable to .env BLACK_LIST_EMAIL=email1,email2

## Run tests
- docker-compose run --rm app vendor/bin/phpunit

## License
The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
