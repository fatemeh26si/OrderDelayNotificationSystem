#!/usr/bin/env bash

while [ true ]
do
  flock -w 0 /var/www/html/app/storage/logs/cron.lock php /var/www/html/app/artisan schedule:run --verbose --no-interaction &
  sleep 60
done
