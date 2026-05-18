#!/usr/bin/env sh
set -eu

if [ -z "${APP_KEY:-}" ]; then
  echo "APP_KEY is missing. Set APP_KEY in Railway variables."
  exit 1
fi

php artisan migrate --force
php artisan db:seed --force

php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
