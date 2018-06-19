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




//================[TESTING ROUTES]====================

//************/Sections/*************

Route::get('/Sections', 'SectionController@getSections');

Route::get('/AddSection', 'SectionController@addSection');
//http://localhost:8000/AddSection?section_name=Mainsection

Route::get('/DeleteSection', 'SectionController@deleteSection');
//http://localhost:8000/DeleteSection?id=2

//*************/Threads/*************

Route::get('/Threads/{id_section}', 'ThreadController@getThreads');
Route::get('/GetDeletedThreads/{id_section}', 'ThreadController@getDeletedThreads');

Route::get('/AddThread', 'ThreadController@addThread'); 
//http://localhost:8000/AddThread?thread_name=TestThread&user_id=2&section_id=7&msg_body=TestMsg

Route::get('/DeleteThread', 'ThreadController@deleteThread');
//http://localhost:8000/DeleteThread?id=2

Route::get('/RestoreThread', 'ThreadController@restoreThread');
//http://localhost:8000/DeleteThread?id=2

//************/Messages/*************

Route::get('/Messages/{id_thread}', 'MessageController@getMessages');
Route::get('/GetDeletedMessages/{id_thread}', 'MessageController@getDeletedMessages');

Route::get('/AddMessage', 'MessageController@addMessage'); 
//http://localhost:8000/AddMessage?msg_name=TestMessage&user_id=2&thread_id=3&msg_body=TestMessageText

Route::get('/DeleteMessage', 'MessageController@deleteMessage');
//http://localhost:8000/DeleteMessage?id=2

Route::get('/RestoreMessage', 'MessageController@restoreMessage');
//http://localhost:8000/DeleteMessage?id=2

//************/Debug/*************
Route::get('/Debug', 'MessageController@Debug');


//================[TESTING ROUTES]====================

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
