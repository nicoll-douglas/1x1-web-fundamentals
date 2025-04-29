DC_BUILD = docker compose -f docker-compose.build.yml --env-file .env.production

DC_DEPLOY = docker compose -f docker-compose.deploy.yml --env-file .env.production

DC_DEV = docker compose -f docker-compose.dev.yml --env-file .env.development

# Run database setup (migrations, seeders etc.)
db-setup:
	set -a; . ./.env.production; set +a; docker exec $$APP_CONTAINER_NAME composer db:setup

# build and/or start development containers
dev-up:
	$(DC_DEV) up --build

# build production application image
deploy-build:
	$(DC_BUILD) build

# push production application images to Docker Hub
deploy-push:
	set -a; . ./.env.production; set +a; docker push $$DOCKERHUB_IMAGE

# pull production images from Docker Hub
deploy-pull:
	$(DC_DEPLOY) pull

# start production containers
deploy-up:
	$(DC_DEPLOY) up -d

deploy-down:
	$(DC_DEPLOY) down

help:
	@echo "Available targets:"
	@echo "  db-setup      - Run database setup (migrations, seeders etc.)"
	@echo "  dev-up        - Build and/or start development containers"
	@echo "  deploy-build  - Build production application image"
	@echo "  deploy-push   - Push production application image to Docker Hub"
	@echo "  deploy-pull   - Pull production images from Docker Hub"
	@echo "  deploy-up     - Start production containers"
	@echo "  deploy-down   - Stop and destroy production containers"

.PHONY: db-setup dev-up deploy-build deploy-push deploy-pull deploy-up deploy-down help
