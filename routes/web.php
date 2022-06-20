<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'/api'], function () use($router){

    $router->group(['prefix'=>'/universidades'], function () use($router){
        $router->get('/','UniversidadController@allInfo');
        $router->get('/{id}','UniversidadController@getById');
        $router->post('/crear','UniversidadController@create');
        $router->put('/actualizar/{id}','UniversidadController@update');
        $router->delete('/eliminar/{id}','UniversidadController@delete');
    });
    $router->group(['prefix'=>'/facultades'], function () use($router){
        $router->get('/','FacultadController@getAll');
        $router->get('/{id}','FacultadController@getById');
        $router->post('/crear','FacultadController@create');
        $router->put('/actualizar/{id}','FacultadController@update');
        $router->delete('/eliminar/{id}','FacultadController@delete');
    });
    $router->group(['prefix'=>'/estudiantes'], function () use($router){
        $router->get('/','EstudianteController@getAll');
        $router->get('/{id}','EstudianteController@getById');
        $router->post('/crear','EstudianteController@create');
        $router->put('/actualizar/{id}','EstudianteController@update');
        $router->delete('/eliminar/{id}','EstudianteController@delete');
    });
});
