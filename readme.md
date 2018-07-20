## OAuth client

### installation:
after cloning repository go to a cloned directory and run: 

    composer install 

make a new .env file:

    cp .env.example .env

generate new key:

    php artisan key:generate

make a new database and set configs in the .env file

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=DBNAME
    DB_USERNAME=DBUSER
    DB_PASSWORD=DBPASS

migrating database:

    php artisan migrate

seeding database:

    php artisan db:seed

it will create user2 with these data:

    email: user2@test.com
    password: 123456
    
run server with port 9901

    php artisan serve --port=9901
    
OAuth client site will be available at:

    127.0.0.1:9901