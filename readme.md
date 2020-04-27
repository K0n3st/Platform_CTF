<h1>Platform-CTF</h1>
  
<p>Laravel-Based Community CTF Platform</p>

## Installation

### Local
  Installation of Platform-CTF in traditional way is easy:
    
    git clone https://github.com/K0n3st/Platform-CTF.git
    composer install
    composer update
    cp env.example .env
    Change name database, user and password Databse in the .env file
    php artisan key:generate
    php artisan migrate
    php artisan db:seed --class=DatabaseSeeder
   
  As Platform-CTF is built on Laravel, please make sure to set the correct parameters in the .env file.
  
### Docker
  With Docker (currently for development purposes only, the production image is work in progress):

    git clone https://github.com/K0n3st/Platform-CTF.git
    cd laradock
    docker-compose up -d nginx mysql
    docker-compose exec app php artisan migrate
    docker-compose exec app php artisan user:create-admin
    
   After creating an administrative user and database connection, the system is ready to use.
   
## License
The Platform-CTF is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


