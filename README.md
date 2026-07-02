To start this demo please do the few thing below

Requirements:
  - Symfony environement
  - php 7.4+
  - mysql 8.2
  - apache server
  - navigator

Installation
  - Composer install
  - npm install

Build style
  - npm run build

run php bin/console cache:clear

1 - Create the database
  - php bin/console doctrine:database:create

2 - Update doctrine schema
  - php bin/console doctrine:schema:update --force

  OU

  - php bin/console make:migration
  - php bin/console doctrine:migrations:migrate

3 - Load the fixtures
  - php bin/console doctrine:fixtures:load

Enjoy the ecommerce demo

Docker setup
  - docker compose up --build
  - open http://localhost:8000
  - the app container will create the database and run the migrations automatically
  - mailpit is available at http://localhost:8025
