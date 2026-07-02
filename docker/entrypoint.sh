#!/bin/sh
set -e

until php -r 'new PDO("mysql:host=database;port=3306;dbname=ecommerce", "app", "app");' >/dev/null 2>&1; do
    echo "Waiting for MySQL to be ready..."
    sleep 2
done

php bin/console doctrine:database:create --if-not-exists >/dev/null 2>&1 || true
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration >/dev/null 2>&1 || true
php bin/console cache:clear >/dev/null 2>&1 || true

exec apache2-foreground
