APP_CONTAINER_NAME := users_app

docker_compose_bin := $(shell command -v docker-compose 2> /dev/null)

build: ## build docker images
	docker-compose build --build-arg UID=$(id -u) --build-arg GID=$(id -g)

up: build ## Start all containers (in background) for development
	$(docker_compose_bin) up --force-recreate -d

down: ## Stop all started for development containers
	$(docker_compose_bin) down --rmi local --remove-orphans

composer: up ## Install composer dependencies
	$(docker_compose_bin) run --rm "$(APP_CONTAINER_NAME)" composer install

migrate: up ## apply latest migrations
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" php artisan migrate

test: up ## Execute application tests
	$(docker_compose_bin) exec "$(APP_CONTAINER_NAME)" vendor/bin/phpunit


