.PHONY: up down stop remove

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
