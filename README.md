composer dump-autoload

php artisan db:seed

## Series I Saw

Keep track of where you are in your favorite series

## Installation

Import the database from seriesisaw.sql (available in the root of the project)

Create a .env file from .env.example file. Fill your .env with database connection information.

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=seriesIsaw  
DB_USERNAME=root  
DB_PASSWORD=bankadmin  

```bash
npm install

composer install

php artisan key:generate

php artisan migrate

php artisan db:seed

npm run dev

php artisan serve
```

There are two types of users, admins and normal users.  
Normal users can be created easily in the root page.  
Admins can be created by changing the column is_admin of a user to true in the user table.

If you ran the seed you will already have a normal user, and an admin created. Access information below:
normal user:  
username: user  
password: test  

admin:  
username: admin  
password: test  

Admins will have the permissions to manage Series and Platforms, these two entities will be used by normal users while managing their Series History


