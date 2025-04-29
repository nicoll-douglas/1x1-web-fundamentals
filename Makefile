setup-db:
	docker exec 1x1_app composer db:setup

dev-up:
	docker compose -f docker-compose.dev.yml up --build

deploy-up:
	docker compose up --build -d