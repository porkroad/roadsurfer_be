start:
	docker-compose up -d --build

php-bash:
	docker-compose exec php /bin/bash

db-bash:
	docker-compose exec database /bin/bash

undo-all:
	docker-compose stop && docker-compose rm -f && rm -rf mysql && mkdir mysql && docker-compose up -d --build
