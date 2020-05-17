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

$router->group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function() use($router)
{

    $router->get('renewals','RenewalController@index');
    $router->post('renewals','RenewalController@store');
    $router->get('renewals/{renewal}','RenewalController@show');
    $router->put('renewals/{renewal}','RenewalController@update');
    $router->patch('renewals/{renewal}','RenewalController@update');
    $router->delete('renewals/{renewal}','RenewalController@destroy');
});

