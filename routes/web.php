<?php

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

$router->group(['prefix' => 'api/', 'middleware' => 'auth'], function () use ($router)
{
  // Business
  $router->get('business','BusinessController@index');
  $router->get('business/{id}','BusinessController@show');
  $router->post('business','BusinessController@store');
  $router->patch('business/{id}','BusinessController@update');
  $router->delete('business/{id}','BusinessController@destroy');

  
  $router->post('logout','UserController@logout');
});
  // Offices
  $router->get('offices/{id_business}','OfficeController@index');
  $router->post('offices/{id_business}','OfficeController@store');
  $router->patch('offices/{id}','OfficeController@update');
  $router->delete('offices/{id}','OfficeController@destroy');
  $router->get('offices/{id}/show','OfficeController@show');
// User
$router->post('login','UserController@authenticate');
$router->post('users','UserController@store');


