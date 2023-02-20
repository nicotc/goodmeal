# PHP Laravel environment
Docker environment required to run Laravel (based on official php and mysql docker hub repositories).

[![Actions Status](https://github.com/systemsdk/docker-nginx-php-laravel/workflows/Laravel%20App/badge.svg)](https://github.com/systemsdk/docker-nginx-php-laravel/actions)
[![CircleCI](https://circleci.com/gh/systemsdk/docker-nginx-php-laravel.svg?style=svg)](https://circleci.com/gh/systemsdk/docker-nginx-php-laravel)
[![Coverage Status](https://coveralls.io/repos/github/systemsdk/docker-nginx-php-laravel/badge.svg)](https://coveralls.io/github/systemsdk/docker-nginx-php-laravel)
[![Latest Stable Version](https://poser.pugx.org/systemsdk/docker-nginx-php-laravel/v)](https://packagist.org/packages/systemsdk/docker-nginx-php-laravel)
[![Total Downloads](https://poser.pugx.org/systemsdk/docker-nginx-php-laravel/downloads)](https://packagist.org/packages/systemsdk/docker-nginx-php-laravel)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

Use la base systemsdk/docker-nginx-php-laravel.git para docker de instalación [Ver Repositorio](https://github.com/systemsdk/docker-nginx-php-laravel.git) <br>
Configuraciones adicionales 
* Comenté la parte de todos los componentes de dev ya que tardaban al momento de crear la build
* Agregré por defecto las variables para el contenedor dentro del .env  Asignandole el puerto 8080<br>
* Instalé el Node a pesar de no usarlo

El swagger esta configurado en "http://localhost:8080/api/documentation#/" Sin embargo, solo tiene el login ya que por algún motivo no toma las anotacciones dentro de los módulos <br><br>

Usé nWidart/laravel-modules para crear los módulos y tener separadas las apis.

En el http://localhost:8080 esta una vista mobile <b>No está integrada a las api</b> 

* Las Apis a excepción del registro y login están protegidas por roles de usuarios y por autenticación Sanctum 
* Todas las Api están organizada en una estructura (api/v1)
* Postman Repositorio [Ver postman](https://www.postman.com/gold-astronaut-813358/workspace/goodmeal) 











