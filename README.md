                        # BaseModule
**********************************************************
country controller path: /var/www/casita_task/app/Modules/users/Http/Controllers/API/CountryController.php
# for docker users

copy .env.example to .env
in .env.testing uncomment database config under for docker and comment database config under for server

# Notes

- Create and start containers
    docker compose up --build -d

# commend for script (composer install and artisan commends  and start test cases)
docker exec -i laravel_php bash /usr/local/bin/dockerInit

http://localhost:8090 => for phpmyadmin
http://localhost:8091 => for phpmyadminTest

localhost:8070 => for project

### From the second time onwards
- `docker-compose exec laravel_php bash`

### Useful Laravel Commands
- Display basic information about your application
    - `php artisan about`
- Remove the configuration cache file
    - `php artisan config:clear`
- Flush the application cache
    - `php artisan cache:clear`
- Clear all cached events and listeners
    - `php artisan event:clear`
- Delete all of the jobs from the specified queue
    - `php artisan queue:clear`
- Remove the route cache file
    - `php artisan route:clear`
- Clear all compiled view files
    - `php artisan view:clear`
- Remove the compiled class file
    - `php artisan clear-compiled`
- Remove the cached bootstrap files
    - `php artisan optimize:clear`
- Delete the cached mutex files created by scheduler
    - `php artisan schedule:clear-cache`
- Flush expired password reset tokens
    - `php artisan auth:clear-resets`
===============================================================================

#if you dont use docker

change .env database config
in .env.testing comment database config under for docker and uncomment database config under for server



first just you need to do composer update then do php artisan migrate --seed
create directory public/upload/media
table users using engine myisam to use full text search

in front list users has input for search in (name, email, phone) just write and enter

still working on this project to make it perfect

1-restructure framework to work as modules mean that every module has its own (controllers, models, views, middlewars, migrations, service providers, routs).
2-auth web and api using jwt-auth

3-admin can (create update delete list) users.

4-admin can block users and change status for users pending to active.

5-facade to handle all uploads dynamic just send request without do any thing and it will working fine upload all(images, videos, docs, Pdf, Logos, avatars) and handle all sizes in .env using spatie-media.

6-about permissions used spatie-permission, permissions added from seeders and admins can create any role and assign any permissions to it and assign this role to any user.

7- handle crm-admin this user has all permissions without assign any permissions.

8- requests validations seperated to handel all requests.

9-every user has its own profile and can update its own data if he has permissions.

used solid, hmvc, design patterns and repository design pattern, controllers just call service , service has logic, service call repository ,repo manage all connections with database and every service and repo has its own interfaces and abstraction to restrict everything and used solid principles in all modules, classes and functions.
