# issfullstack

![alt text](https://raw.githubusercontent.com/kevinm9/issfullstack/main/uix.png)


## video  https://img.youtube.com/vi/dUcBe5tnLMU/0.jpg
```
https://www.youtube.com/watch?v=dUcBe5tnLMU
```
[![](  https://img.youtube.com/vi/dUcBe5tnLMU/0.jpg )](https://www.youtube.com/watch?v=dUcBe5tnLMU)

## ambiente
```
windows 10
laragon full 6.0.0
php 8.1.1
mysql 8 
nodejs 18.18.1
```
"Clonar primero los repositorios y situarse en las carpetas correspondientes."
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
crear la base de datos laravel , usuario root sin clave configuracion por defecto de laragon
```
php artisan key:generate
php artisan migrate:fresh --seed
```
levantar aplicativo
```
php artisan serve
```



## levantar frontend vue
```
npm install
```
```
npm run dev
```
