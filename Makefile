.PHONY: help up down restart shell artisan migrate migrate-fresh migrate-refresh migrate-rollback seed test pint phpstan composer npm npm-install npm-dev npm-watch npm-build queue-work cache-clear config-clear route-clear view-clear logs

.DEFAULT_GOAL := help

help:
	@echo "Available commands:"
	@grep -E '^\.PHONY:' $(MAKEFILE_LIST) | sed 's/\.PHONY: //' | tr ' ' '\n' | grep -v '^help$$' | sort | xargs -n1 echo "  -"

up:
	./vendor/bin/sail up -d

down:
	./vendor/bin/sail down

restart:
	./vendor/bin/sail down && ./vendor/bin/sail up -d

shell:
	./vendor/bin/sail shell

migrate:
	./vendor/bin/sail artisan migrate

migrate-fresh:
	./vendor/bin/sail artisan migrate:fresh

migrate-refresh:
	./vendor/bin/sail artisan migrate:refresh

migrate-rollback:
	./vendor/bin/sail artisan migrate:rollback

seed:
	./vendor/bin/sail artisan db:seed

test:
	./vendor/bin/sail artisan test

pint:
	./vendor/bin/sail pint

phpstan:
	./vendor/bin/phpstan --memory-limit=1g

npm-install:
	./vendor/bin/sail npm install

npm-dev:
	./vendor/bin/sail npm run dev

npm-watch:
	./vendor/bin/sail npm run watch

npm-build:
	./vendor/bin/sail npm run build

queue-work:
	./vendor/bin/sail artisan queue:work

cache-clear:
	./vendor/bin/sail artisan cache:clear
	./vendor/bin/sail artisan config:clear
	./vendor/bin/sail artisan route:clear
	./vendor/bin/sail artisan view:clear
	./vendor/bin/sail artisan optimize:clear
	./vendor/bin/sail artisan event:clear
	./vendor/bin/sail artisan filament:clear-cached-components

config-clear:
	./vendor/bin/sail artisan config:clear

route-clear:
	./vendor/bin/sail artisan route:clear

view-clear:
	./vendor/bin/sail artisan view:clear

init:
	docker compose down
	@echo "Initializing Laravel Sail environment..."
	@echo "Copying .env.example to .env if .env does not exist..."
	if [ -f .env ]; then echo "env exists"; else cp .env.example .env; fi
	@echo "Running composer install..."
	composer install --no-interaction --ignore-platform-reqs
	@echo "Starting Laravel Sail services..."
	./vendor/bin/sail up -d --build
	./vendor/bin/sail composer install --no-interaction --optimize-autoloader
	@echo "Running npm install..."
	./vendor/bin/sail npm install
	./vendor/bin/sail npm run build
	@echo "Running artisan commands..."
	./vendor/bin/sail artisan key:generate
	@echo "Running additional artisan commands..."
	./vendor/bin/sail artisan storage:link
	./vendor/bin/sail artisan migrate:fresh --seed
	./vendor/bin/sail artisan optimize:clear
	./vendor/bin/sail artisan config:cache
	./vendor/bin/sail artisan route:cache
	./vendor/bin/sail artisan view:cache
	./vendor/bin/sail artisan event:cache
	./vendor/bin/sail artisan filament:optimize
	./vendor/bin/sail artisan about
	@echo "Laravel Sail environment initialized successfully."
	@echo "Visit $$(grep ^APP_URL= .env | cut -d '=' -f2-)"
