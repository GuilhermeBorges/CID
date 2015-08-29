<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Route with get request no the page '/' we will do functio()
// If I would like to look for a controler X and call a method Y it should be: ...::get('/','X@Y');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('easteregg','EEcontroler@helloworld');
// Route::get('about','AboutController@index');
Route::get('index','PagesController@index');
Route::get('about','PagesController@about');
Route::get('capitulo','PagesController@capitulo');
Route::get('doencas','PagesController@doencas');
Route::get('especifica','PagesController@especifica');
Route::get('scrapping','ScrappingController@scrapping');