composer create-project --prefer-dist laravel/laravel:^10.0 example-app
composer install
php artisan migrate
php artisan serve

php artisan install:api

php artisan make:model Name -m
php artisan make:model Name -mf
php artisan db:seed
php artisan migrate:refresh --seed
php artisan make:factory BookFactory --model=Book
php artisan make:controller ReviewController  --resource
php artisan make:controller PhotoController --model=Photo --resource --requests --api
# https://tailwindcss.com/docs/guides/laravel
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
npm run dev
# https://alpinejs.dev/

# API
php artisan make:controller Api/AttendeeController --api
php artisan route:list
php artisan make:seeder EventSeeder
php artisan make:resource UserResource
php artisan make:resource User --collection

https://laravel.com/docs/10.x/sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan vendor:publish --tag=sanctum-migrations
php artisan migrate

php artisan make:policy PostPolicy --model=Post


php artisan make:command SendEventReminders

# schedule
https://laravel.com/docs/10.x/scheduling
App\Console\Kernel
php artisan schedule:list

php artisan make:notification EventReminderNotification

php artisan schedule:work
or
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

# queue
https://laravel.com/docs/10.x/queues#creating-jobs
php artisan queue:table
php artisan migrate
QUEUE_CONNECTION=database
php artisan make:job ProcessPodcast
php artisan queue:work
php artisan queue:listen

# Динамічні сторінки
https://livewire.laravel.com/docs/installation
composer require livewire/livewire
php artisan livewire:publish --config
php artisan livewire:publish --assets

php artisan make:livewire CreatePost

# DebugBar
https://github.com/barryvdh/laravel-debugbar
composer require barryvdh/laravel-debugbar --dev
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"

# Tests
php artisan make:test UserTest

run
./vendor/bin/pest

php artisan make:test UserTest --unit

run
./vendor/bin/phpunit

run all
php artisan test
php artisan test --testsuite=Feature --stop-on-failure

# Observers
php artisan make:observer UserObserver --model=User
