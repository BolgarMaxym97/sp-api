DEPLOYMENT
==========

1. Clone this repo and navigate to just created folder
    ~~~
    git clone git@github.com:WaitesWireless/sso-server.git
    cd sso-server
    ~~~
2. Install dependencies with [composer](https://getcomposer.org/)
    ~~~
    composer install
    ~~~
3. Copy `.env.example` file to `.env`
    ~~~
    cp .env.example .env
    ~~~
4. Generate application key. Key will be stored into `APP_KEY` param of `.env` file  
    ~~~
    php artisan key:generate
    ~~~
5. Set database settings into `.env` file
6. ***For production:*** set `APP_ENV` property value to `production` and `APP_DEBUG` to `false` in `.env` file to avoid displaying server errors with stacktrace to users
7. Run migrations 
    ~~~
    php artisan migrate
    ~~~
8. Seed the database with initial data
    ~~~
    php artisan db:seed
    ~~~
    9. Generate OAuth private/public keys into `/storage` folder
    ~~~
    php artisan passport:keys
    ~~~
9. Generate ide-helper file:
    ~~~
    php artisan ide-helper:generate
    php artisan ide-helper:models
    ~~~
