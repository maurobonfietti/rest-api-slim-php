.PHONY: up down nginx php phplog nginxlog db coverage vendor

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))
CONTAINERS := $(shell docker ps -a -q -f "name=rest-api-slim-php*")

up:
	docker-compose up -d --build

down:
	docker-compose down

nginx:
	docker exec -it rest-api-slim-php-nginx-container bash

php: 
	docker exec -it rest-api-slim-php-php-container bash

phplog: 
	docker logs rest-api-slim-php-php-container

nginxlog:
	docker logs rest-api-slim-php-nginx-container

db:
	docker-compose exec mysql mysql -e 'DROP DATABASE IF EXISTS rest_api_slim_php ; CREATE DATABASE rest_api_slim_php;'
	docker-compose exec mysql sh -c "mysql rest_api_slim_php < docker-entrypoint-initdb.d/database.sql"

coverage:
	docker-compose exec php-fpm sh -c "./vendor/bin/phpunit --coverage-text --coverage-html coverage"

vendor:
	docker-compose exec php-fpm sh -c "composer install"
