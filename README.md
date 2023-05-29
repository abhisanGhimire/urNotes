<h2 align="center">urNotes</h2>

Simple note application developed to practice laravel authentication, MVC architecture and CRUD operation.

# Installation process

Navigate to the desired installation folder and run following code

```bash
git clone https://github.com/abhisanGhimire/urNotes
```

## Install Composer

```bash
composer install
```

## .env file

```bash
Copy .env.example to .env(create a new file)
```

## Generate app key

```python
php artisan key:generate
```

## Setup Database
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=[database_name]
DB_USERNAME=[database_username]
DB_PASSWORD=[database_password]
```
Migrate database tables
```
php artisan migrate
```
Seed the database if needed, else you are all set
```
php artisan db:seed
```
# Maintenance process

Pull code
```
git pull
```
Add code to git
```
git add .
```
Commit code
```
git commit -m "message_you_want_to_convey"
```

Push code
```
git push -u origin master
```
