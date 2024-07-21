### Software Stack
- Docker 27.0.3
- PHP 8.2.3
- MySQL 8.1.0
- Laravel 11.5.0
- AdminLTE-3.2.0


### Base Settings
1. Run git clone
2. Run cp .env.example .env
3. Set up your settings in .env:
    - DOCKER_NGINX_PORT
    - DOCKER_USERNAME
    - DOCKER_USER_ID
4. Run docker compose build
5. Run docker compose up -d
6. docker exec -it builder-app bash
7. Run composer install
8. Run php artisan key:generate
9. Run php artisan migrate
