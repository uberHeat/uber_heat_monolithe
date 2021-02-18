# Dockerize symfony/website-skeleton

## Prerequisites :

- install docker-ce
- install docker-compose

## Used docker images

- nginx:1.15.5-alpine
- custom php ( based on php:7.2.11-fpm ) (cf /docker/php/Dockerfile)
- mysql:5.7

## Install

From project path run the following command:

```
$  docker-compose pull
$  make .env
$  make install-deps
```

Once done edit .env with your custom variables

## Start

```
$  make start
```

and browse http://localhost:8081/

## Stop

```
$  make stop
```

## Open term in php container

```
$  make php
```

API

> An app just for try api platform

## Built With

* [Symfony](https://github.com/symfony/symfony) - Symfony is a PHP framework for web and console applications and a set of reusable PHP components
* [Api platform](https://github.com/api-platform/api-platform) - REST and GraphQL framework to build modern API-driven projects

## Development setup

How to set up the development environment :
- how to create db ?
- how to fill it ?
- how to run test-suite ?

```bash
# Database connection
# Just update the .env file custom every variable that inside <...>
DATABASE_URL="mysql://<user>:<password>@<127.0.0.1>:<3306>/<db_name>?serverVersion=5.7"
DATABASE_URL="postgresql://<user>:<password>@<127.0.0.1>:<5432>/<db_name>?serverVersion=13&charset=utf8"

# JWT configuration
$ mir -p config/jwt
$ openssl genkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ enssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
$ chmod -R 644 config/jwt/*

# Database setup
$ bin/console doctrine:database:create
$ bin/console doctrine:migrations:migrate

# Fill database with fake data
$ bin/console doctrine:fixtures:load

# run test
## Be careful the test suite is executed directly in the Database !
$ bin/phpunit

# lint the code
##Tchech line to update
$ vendor/bin/phpcs -n
## Fix those lines
$ vendor/bin/php-cs-fixer fix

# Reset de la base de donnees
# A NE SURTOUT PAS FAIRE EN PROD !
$ bin/console d:d:d --force && bin/console d:d:c && bin/console d:m:m && bin/console d:f:l

# Update all dependencies
## See : https://symfony.com/doc/current/setup/unstable_versions.html
## See : https://symfony.com/releases
## See : https://symfony.com/doc/current/setup/upgrade_major.html#upgrade-major-symfony-deprecations
$ composer update
```

Some useful command if you want to create or update db scheme and then migrate them.
```bash
# Create an entity
$ bin/console make:entity <NameYourEntity>

# Create a migration
$ bin/console make:migration
```

## Organisation
```bash
.
├─ migrations                   -> History of all db update create with the command : $ bin/console make:migration
│   ├─ VersionX.php
│   └─ VersionX.php
├─ src
│   ├─ Controller               -> 
│   ├─ DataFixtures             -> All fake data you thats add into db when u execute : $ bin/console doctrine:fixtures:load
│   ├─ Entity                   -> All the database entity and object definition are store here
│   ├─ EventListener            -> 
│   ├─ Events                   -> 
│   ├─ Repository               -> 
│   ├─ Services                 -> 
│   └─ Swagger                  -> 
└─ tests                        -> In this folder you have all tests executed with the command : $ bin/phpunit
    ├─ Func                     -> Functional tests
    └─ Unit                     -> Unit tests
```

## Release History

* 0.0.1
    * Work in progress

## Authors

Alban PIERSON – pro.pierson.alban@gmail.com

## License

This project is licensed under the GNU GPL v3 License - see the [LICENSE.md](LICENSE.md) file for details