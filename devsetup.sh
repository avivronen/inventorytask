#@author Aviv

echo 'Starting development environment setup'
echo '************Creating Docker containers******************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
docker-compose up -d

echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '************Setup laravel dev env inside docker *********'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
docker exec  aviv-inventorybackend-php-fpm bash -c "ls -la;cp .env.example .env; composer global require laravel/installer;
composer install;
find /application/ -type f -exec chmod 644 {} \;
find /application -type d -exec chmod 755 {} \;
ls -la;
chown -R 1000:1000 /application/;
chmod -R 777 /application/storage;
chmod -R 777 /application/bootstrap/cache/;
chmod -R 777 /application/public/;
php artisan migrate:fresh;
php artisan migrate:install;
php artisan migrate;
php artisan db:seed;
exit;"


echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '************Setup VUEJS NODE dev environment ************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
docker exec -d aviv-inventoryfront-node /bin/sh -c "npm install;npm run serve;exit;"

echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo 'Setup was a success'
echo 'sales email: sales@user.com, password is password123'
echo '*********************************************************'
echo '*********************************************************'
echo '*********************************************************'
echo 'Opening chrome'
google-chrome 'http://localhost:8080'




