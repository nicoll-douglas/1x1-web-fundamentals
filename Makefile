

DC_BUILD = docker compose -f docker-compose.build.yml --env-file secrets/.env

DC_DEPLOY = docker compose -f docker-compose.deploy.yml --env-file secrets/.env

DC_DEV = docker compose -f docker-compose.dev.yml --env-file secrets/.env

setup-db:
	docker exec 1x1_app composer db:setup

dev-up:
	$(DC_DEV) up --build

build:
	$(DC_BUILD) build

push:
	set -a; . secrets/.env; set +a; docker push $$DOCKERHUB_IMAGE

