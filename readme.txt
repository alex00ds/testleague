Install:
composer update

Start:
php artisan serve --port=8888

Get token: POST http://localhost:8888/auth/login
with params:
login test
password passtest

Check API: http://localhost:8888/leagues
