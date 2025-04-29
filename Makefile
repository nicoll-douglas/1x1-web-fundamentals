DC_BUILD = docker compose -f docker-compose.build.yml --env-file secrets/.env

DC_DEPLOY = docker compose -f docker-compose.deploy.yml --env-file secrets/.env

DC_DEV = docker compose -f docker-compose.dev.yml --env-file secrets/.env

# Run database setup (migrations, seeders etc.)
db-setup:
	docker exec 1x1_app composer db:setup

# build and/or start development containers
dev-up:
	$(DC_DEV) up --build

# build production application image
deploy-build:
	$(DC_BUILD) build

# push production application images to Docker Hub
deploy-push:
	set -a; . secrets/.env; set +a; docker push $$DOCKERHUB_IMAGE

# pull production images from Docker Hub
deploy-pull:
	$(DC_DEPLOY) pull

# start production containers
deploy-up:
	$(DC_DEPLOY) up