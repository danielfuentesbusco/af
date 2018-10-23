# Instalación

Ejecutar comando ```composer update``` para descargar y actualizar dependencias, luego ejecutar comando ```php artisan preset bootstrap && npm install && npm run dev```

Renombrar archivo ```.env.example``` a ```.env``` e ingresar información de conexión a la base de datos.

Para crear base de datos ejecutar el siguiente comando:

```
php artisan migrate
```

Para llenar la base de datos con la data de prueba, ejecutar los siguientes comandos:

```
php artisan db:seed --class=RolesTableDataSeeder
php artisan db:seed --class=UsersTableDataSeeder
php artisan db:seed --class=QuestionsTableDataSeeder
```

Se crearán 2 usuarios administradores con los siguientes correos: admin1@mail.com, admin2@mail.com, todos con password 123456.

Se crearán 5 usuarios normales con los siguientes correos: usuario1@mail.com, usuario2@mail.com, usuario3@mail.com, usuario4@mail.com, usuario5@mail.com, todos con password 123456.

# Ejecutar

Para realizar pruebas se debe ejecutar el siguiente comando ```php artisan serve``` e ingresar a la URL desplegada y hacer click en LOGIN o REGISTER del menú superior.