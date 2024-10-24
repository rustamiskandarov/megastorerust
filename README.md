# Megastore webapp

## Megastore webapp 
#
Deployment project
- docker-compose up --build
- docker-compose exec php-cli composer install
- docker-compose exec node npm install
- 
- docker-compose exec php-cli php artisan app:install

Enter php command
- docker-compose exec php-cli bash
- docker-compose exec php-fpm bash

Install npm packages

- docker-compose exec node npm install packagesname

Build
- docker-compose exec node npm run build

Development mode

- docker-compose exec node npm run dev

