# laravel-jenkins-test

## Build from source:

```bash
cd .docker
make build
```

## Set-up

You should place "laravel" folder with laravel app in it, and "mysql" with an installation of mysql (and a database, of course).
If you don't have a mysql database placed, docker will create one for you.

## If none laravel install is present, install it:

1. Enter into the container with:

```bash
docker compose exec laravel bash
```

2. Install Laravel with composer (*--prefer-dist* will download Laravel as one compressed file. It's faster)

```bash
composer create-project --prefer-dist laravel/laravel
```

3. Enter into .docker folder and do:

```bash
make up
```

Docker container will start with all their 4 services (nginx, laravel, mysql, phpmyadmin)