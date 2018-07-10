<?php

Route::get('/', function(){
    return redirect('/Sections');
});

//************/Sections/*************

Route::get('/Sections', 'SectionController@getSections');

Route::post('/AddSection', 'SectionController@addSection')->middleware('add');

Route::post('/DeleteSection', 'SectionController@deleteSection')->middleware('delete');

Route::post('/EditSection', 'SectionController@editSection');//->middleware

//*************/Threads/*************

Route::get('/Threads/{section_id}', 'ThreadController@getThreads');
Route::get('/GetDeletedThreads/{id_section}', 'ThreadController@getDeletedThreads');

Route::post('/AddThread', 'ThreadController@addThread')->middleware('add');

Route::post('/EditThread', 'ThreadController@editThread')->middleware('edit');

Route::post('/DeleteThread', 'ThreadController@deleteThread')->middleware('delete');

Route::get('/RestoreThread', 'ThreadController@restoreThread');//->middleware

//************/Messages/*************

Route::get('/Messages/{id_thread}', 'MessageController@getMessages');
Route::get('/GetDeletedMessages/{id_thread}', 'MessageController@getDeletedMessages');

Route::post('/AddMessage', 'MessageController@addMessage')->middleware('add');

Route::post('/EditMessage', 'MessageController@editMessage')->middleware('edit');

Route::post('/DeleteMessage', 'MessageController@deleteMessage')->middleware('delete');

Route::get('/RestoreMessage', 'MessageController@restoreMessage');//->middleware

//**************/User/**************

Route::get('/user/{id}', 'UserInfoController@getUser');

Route::post('/ChangeRole', 'UserInfoController@selectRole')->middleware('edit');

Route::post('/EditBio', 'UserInfoController@editBio');

//**************/Load/**************
Route::get('/load', 'AvatarController@load');
Route::post('loadImage', 'AvatarController@store');

//**************/Auth/**************
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/VKLogin', 'Auth\RegisterController@vkLogin');
