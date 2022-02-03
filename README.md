<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



## Clonar el proyecto

git clone https://github.com/xtdrack/gdalabtest.git

## Modificar el archivo .env de configuracion

- **APP_DEBUG=false**
- **DB_CONNECTION=mysql**
- **DB_HOST=127.0.0.1**
- **DB_PORT=3306**
- **DB_DATABASE=mydb**  //You data base name
- **DB_USERNAME=yourUser**
- **DB_PASSWORD=yourPass**

## Crear el esquema


Create schema mydb;
## Crear regiones y comunas de prueba
{



- **INSERT INTO `mydb`.`regions` (`description`, `status`) VALUES ('reg 1', 'A');**
- **INSERT INTO `mydb`.`communes` (`id_reg`, `description`, `status`) VALUES ('1', 'com 1', 'A');**
- **INSERT INTO `mydb`.`communes` (`id_reg`, `description`, `status`) VALUES ('1', 'com 2', 'A');**



}

## Crear un propiedad en el archivo .env
validacion de producción y logs
- **IS_PROD = false**
- **IS_PROD = true**



## Ejecutar el proyecto

Abrir un terminal en la raiz del proyecto y ejectar

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

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/registro.png" width="550"></a></p>
## Iniciar sesión 

End point localhost:8000/api/login

{   

    "email": "ale",
    "password": "123456"
    
}

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/login.png" width="550"></a></p>

## Recibe un token

Se recibe un token y una fecha de expiración que es una hora despues del inicio de sesión

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/Screenshot_2.png" width="550"></a></p>

## Se puede consumir el servicio rest



### Crear Consumidores

End Point POST
localhost:8000/api/createcustomer
{


            "dni" : "5030707615",
            "id_reg" : 1,
            "id_com" : 1,
            "email" : "eliza.yupa@gmail.com",
            "name" : "pau",
            "last_name" : "yupangui",
            "address" : "lazo",
            "date_reg" : "2022-02-02 11:11:11",
            "status" : "A",
            "token": "changeMe"



}

**Todos los campos son obligatorios excepto la dirección (address)**

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/crear.png" width="550"></a></p>


### Consultar Consumidores 

End Point GET 
localhost:8000/api/createcustomer



Se utilizan parametros en la URL por ejemplo:

### Consulta por DNI
End Point GET 
localhost:8000/api/createcustomer?dni=5030707615&token=changeMe

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/consultar.png" width="550"></a></p>

### Consulta por Email
End Point GET 
localhost:8000/api/createcustomer?email=eliza.yupa@gmail.com&token=**changMe**


### Eliminado lógico
End Point DELETE
localhost:8000/api/createcustomer?dni=5030707615&token=changeMe

<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://131.196.8.4/tracking/eliminar.png" width="550"></a></p>

