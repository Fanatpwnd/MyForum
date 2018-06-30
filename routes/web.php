<?php

Route::get('/', function(){
    return redirect('/Sections');
});

//************/Sections/*************

Route::get('/Sections', 'SectionController@getSections');

Route::get('/AddSection', 'SectionController@addSection');

Route::post('/DeleteSection', 'SectionController@deleteSection');

Route::get('/EditSection', 'SectionController@editSection');

//*************/Threads/*************

Route::get('/Threads/{id_section}', 'ThreadController@getThreads');
Route::get('/GetDeletedThreads/{id_section}', 'ThreadController@getDeletedThreads');

Route::post('/AddThread', 'ThreadController@addThread'); 

Route::post('/EditThread', 'ThreadController@editThread');

Route::post('/DeleteThread', 'ThreadController@deleteThread')->middleware('delete');

Route::get('/RestoreThread', 'ThreadController@restoreThread');

Route::get('/EditThrread', 'ThreadController@editThread');

//************/Messages/*************

Route::get('/Messages/{id_thread}', 'MessageController@getMessages');
Route::get('/GetDeletedMessages/{id_thread}', 'MessageController@getDeletedMessages');

Route::post('/AddMessage', 'MessageController@addMessage'); 

Route::post('/EditMessage', 'MessageController@editMessage');

Route::post('/DeleteMessage', 'MessageController@deleteMessage')->middleware('delete');

Route::get('/RestoreMessage', 'MessageController@restoreMessage');

//**************/User/**************
Route::get('/user/{id}', 'UserInfoController@getUser');

//**************/Load/**************
Route::get('/load', 'AvatarController@load');
Route::post('loadImage', 'AvatarController@store');

//**************/Auth/**************
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
