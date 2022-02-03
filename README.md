<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Clonar el proyecto

git clone https://github.com/xtdrack/gdalabtest.git

## Modificar el archivo .env de configuracion

APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydb //You data base name
DB_USERNAME=yourUser
DB_PASSWORD=yourPass

## Crear un propiedad
validacion de producción
IS_PROD = false
IS_PROD = true 

## Ejecutar el proyecto

Abrir un terminal en la raiz del proyecto y ejectur

php artisan serve

Verificar que este funcionando si es en local "localhost:8000"

## Ejecutas las migraciones en el siguiente end point

Haciendo referencia a que el proyecto esta en local

localhost:8000/api/reset

## Se debe crear un usuario para poder hacer uso de la aplicacion

End point localhost:8000/api/register

{   
    "name": "alejo",
    "email": "ale",
    "password": "123456"
}


## Iniciar sesión 

End point localhost:8000/api/login

{   
    
    "email": "ale",
    "password": "123456"
}

## Recibe un token

Se recibe un token y una fecha de expiracion que es una hora despues del inicio de sesión

## Se puede consumir el servicio rest



##Crear Consumidores

End Point POST
localhost:8000/api/createcustomer
{
"dni" : "05030707615",
            "id_reg" : 1,
            "id_com" : 1,
            "email" : "eliza.yupa@gmail.com11111",
            "name" : "pau",
            "last_name" : "yupangui",
            "address" : "lazo",
            "date_reg" : "2022-02-02 11:11:11",
            "status" : "A",
            "token": "3be0d7f9a28035e1b6228f92c33504e0bee94f93"

}
Todos los campos son obligatorios excepto la dirección (address)


##Consultar Consumidores 

End Point GET 
localhost:8000/api/createcustomer



Se utilizan parametros en la URL por ejemplo:

PA

localhost:8000/api/createcustomer




Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
