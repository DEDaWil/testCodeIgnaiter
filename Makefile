# Имя сервиса, которое используете для приложения в docker-compose.yml
APP_CONTAINER_NAME=app

# Выполнения миграций
migrate:
	docker-compose exec $(APP_CONTAINER_NAME) php spark migrate

# Откат предыдущей миграции
migrate-rollback:
	docker-compose exec $(APP_CONTAINER_NAME) php spark migrate:rollback

# Создания миграции
make-migration:
	docker-compose exec $(APP_CONTAINER_NAME) php spark make:migration;

composer-update:
	docker-compose exec $(APP_CONTAINER_NAME) composer update;

composer-install:
	docker-compose exec $(APP_CONTAINER_NAME) composer install;
