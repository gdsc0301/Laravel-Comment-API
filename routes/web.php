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
Route::get('/home', 'HomeController@index')->name('home');


/*
|-----------------------|
| ComMeeting API Routes |
|-----------------------|
*/

//Send a new comment, the text is sent by 'data' in AJAX.
Route::post('/comments/add', array('uses' => 'CommentController@NewComment'));
//Returns all the comments in JSON format.
Route::get('/comments', 'CommentController@GetComments');
//Update a comment whith the follow 'id', the text is send by 'data' in AJAX.
Route::put('/comment/id={id}', array('uses' => 'CommentController@UpdateComment'));
//Here the comment with the follow 'id' is deleted,
//but the 'id' is sent by 'data' in 'post', for security purposes.
Route::post('/comment/delete', 'CommentController@DeleteComment');


/*
|---------------------------|
| End ComMeeting API Routes |
|---------------------------|
*/
