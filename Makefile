# Имя сервиса, которое используете для приложения в docker-compose.yml
APP_CONTAINER_NAME=app

# Команда для выполнения миграций в контейнере
migrate:
	docker-compose exec $(APP_CONTAINER_NAME) php spark migrate

# Откат предыдущей миграции
migrate-rollback:
	docker-compose exec $(APP_CONTAINER_NAME) php spark migrate:rollback

# Команда для создания миграции
make-migration:
	docker-compose exec $(APP_CONTAINER_NAME) php spark make:migration;

# Команда для создания миграции
composer-update:
	docker-compose exec $(APP_CONTAINER_NAME) composer update;
