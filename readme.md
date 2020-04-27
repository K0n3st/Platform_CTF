<h1>Platform-CTF</h1>
  
<p>Laravel-Based Community CTF Platform</p>

## Installation

### Local
  Installation of Platform-CTF in traditional way is easy:
    
    git clone https://github.com/K0n3st/Platform-CTF.git
    composer install
    composer update
    cp env.example .env
    Change name database, user and password Database in the .env file
    php artisan key:generate
    php artisan migrate
    php artisan db:seed --class=DatabaseSeeder
   
  As Platform-CTF is built on Laravel, please make sure to set the correct parameters in the .env file.
  
### Docker
  With Docker (currently for development purposes only, the production image is work in progress):

    git clone https://github.com/K0n3st/Platform-CTF.git
    cd laradock
    cp env.example .env
    docker-compose up -d nginx mysql
    docker-compose exec mysql bash
    
      root@c2772502897c:/# mysql -u root -p
      mysql> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
      mysql> ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';
      mysql> ALTER USER 'default'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';
      mysql> create database namedatabase;
      exit
      exit
  We go back to the Laradock .env file and edit MYSQL_DATABASE and MYSQL_ROOT_PASSWORD
  Then we configure the Laravel .env to take the data we create.
  We restart the containers.
      
    docker-compose down
    docker-compose up -d nginx mysql
    
  And finally we execute migrations.
    docker-compose exec workspace bash
    php artisan key:generate
    php artisan migrate
    php artisan db:seed --class=DatabaseSeeder
    
   After creating an administrative user and database connection, the system is ready to use.
   
## License
The Platform-CTF is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


