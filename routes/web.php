<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', 'HomeController@index')->name('home');

  Route::get('/project/list', 'ProjectController@Project');  //project
  Route::post('/project/add', 'ProjectController@AddProject');
  Route::get('/project/{Id}/delete', 'ProjectController@DeleteProject');

  Route::get('/action/view/{Id}', 'ProjectController@ActionView'); //action view

  Route::post('/project/{Id}/timeline/add', 'ProjectController@AddTimeline'); //add Timeline

  Route::get('/exportTimelineToExcel/{type}/{Project_Id}', 'ProjectController@exportExcel'); //download Timeline to Excel

  Route::get('/project/{Id}/{Project_Id}/timeline/edit', 'ProjectController@viewEditTimeline'); //edit Timeline
  Route::post('/project/{Id}/{Project_Id}/timeline/edit', 'ProjectController@editTimeline');

  Route::post('/project/{Id}/documents/add', 'ProjectController@AddDocuments'); //add Documents
  Route::get('/project/{Id}/{Project_Id}/documents/delete', 'ProjectController@DeleteDocuments'); //delete Documents

  Route::post('/project/setting/{Id}', 'ProjectController@SettingProject'); //Setting Project

  Route::get('/client/list', 'ProjectController@Client'); //client
  Route::post('/client/add', 'ProjectController@AddClient');
  Route::get('/viewImage/{folder_name}/{file_name}', 'ImagesController@view'); //upload image

  Route::get('/user/list', 'ProjectController@User'); //user
  Route::post('/user/add', 'ProjectController@AddUser');

  Route::get('/user/delete/{id}', 'ProjectController@DeleteUser');

  Route::get('/role/list', 'ProjectController@Role'); //role
  Route::post('/role/add', 'ProjectController@AddRole');
  Route::get('/role/edit/{Id}', 'ProjectController@viewEditRole'); //edit role
  Route::post('/role/edit/{Id}', 'ProjectController@EditRole');
});
