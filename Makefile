up:
	docker-compose up -d --build

init:
	docker-compose exec app sh run.sh

enter:
	docker-compose exec app /bin/bash

logs:
	docker-compose logs -f

logs-app:
	docker-compose logs -f app
