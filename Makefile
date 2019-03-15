.PHONY: up down stop remove

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))
CONTAINERS := $(shell docker ps -a -q -f "name=rest-api-slim-php*")

up:
	docker-compose up -d --build

down:
	docker-compose down

nginx:
	docker exec -it platform-api-nginx-container bash

php: 
	docker exec -it platform-api-php-container bash

phplog: 
	docker logs platform-api-php-container

nginxlog:
	docker logs platform-api-nginx-container
