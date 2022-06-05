# Deployment
Run:
```
cp .env.example .env
```
You need to write in the **.env** file the data for connecting to the database. And then:
```
composer install
php artisan migrate
php artisan db:seed
php artisan key:generate
```
# Admin account
By default: 
login - *admin*,
password - *password*.