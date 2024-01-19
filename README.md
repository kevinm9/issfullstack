# issfullstack

![alt text](https://raw.githubusercontent.com/kevinm9/issfullstack/main/uix.png)
## ambiente
```
windows 10
laragon full 6.0.0
php 8.1.1
mysql 8 
nodejs 18.18.1
```

## levantar backend laravel

```
composer install
cp .env.example .env
```
## configuracion de conexion bd arhivo .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan key:generate
php artisan migrate:fresh --seed
```



## levantar frontend vue
```
npm install
```
```
npm run serve
```
