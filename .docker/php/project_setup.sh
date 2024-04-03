#!/bin/bash
# Create log file for Laravel and give it write access
# www-data is a standard apache user that must have an
# access to the folder structure
if [ ! -f ".env" ]; then
    echo "Creating .env file"
    cp .env.exapmle .env
else
echo "env file exists."
fi
chgrp -R www-data storage bootstrap/cache && \
chown -R www-data storage bootstrap/cache && \
# find ./ -type f -exec chmod 644 {} \
# find ./ -type d -exec chmod 755 {} \
chmod -R ug+rwx storage bootstrap/cache && \
chmod 776 storage/ -R
#now running composer install and npm install
composer update  --ignore-platform-reqs #&& npm install
#finally rebuild npm to serve prod.
# npm run prod

php artisan key:generate

php artisan migrate --seed

php artisan config:clear && php artisan config:cache
echo "Permission setup Done... Project now ready to serve"

php artisan test

exec "$@"

