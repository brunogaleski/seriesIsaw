composer dump-autoload

php artisan db:seed

## Series I Saw

Keep track of where you are in your favorite series

## Installation

Import the database from seriesisaw.sql (available in the root of the project)

Fill the following information in .env with connection information from the imported database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seriesIsaw
DB_USERNAME=root
DB_PASSWORD=bankadmin

```bash
npm install

php artisan migrate

php artisan db:seed

php run dev

php artisan serve
```




