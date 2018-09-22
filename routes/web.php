<?php
use App\User;
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

//Comments
//Send a new comment, the text is sent by 'data' in AJAX.
Route::post('comments/add', array('uses' => 'CommentController@NewComment'));
//Returns all the comments in JSON format.
Route::get('/comments', 'CommentController@GetComments');
//Update a comment whith the follow 'id', the text is send by 'data' in AJAX.
Route::put('/comment/id={id}', array('uses' => 'CommentController@UpdateComment'));
//Here the comment with the follow 'id' is deleted,
//but the 'id' is sent by 'data' in 'post', for security purposes.
Route::post('/comment/delete', 'CommentController@DeleteComment');

//User
//Get an user from his ID.
Route::get('/profile/id={id}', function($id){
  $user = User::find($id);
  return view('user.profile')->with('user', $user);
});
//Send the data to create a new user
Route::post('/profile/add', array('uses' => 'UserController@Create'));
//Send the id to delete an user
Route::post('/profile/delete', array('uses' => 'UserController@Delete'));
//Send the data to update the user avatar
Route::post('/profile/avatar-update', array('uses' => 'UserController@AvatarUpdate'));
//Send the data to update the user name
Route::post('/profile/name-update', array('uses' => 'UserController@NameUpdate'));
//Send the data to update the user email
Route::post('/profile/email-update', array('uses' => 'UserController@EmailUpdate'));
//Send the data to update the user password
Route::post('/profile/password-update', array('uses' => 'UserController@PasswordUpdate'));

/*
|---------------------------|
| End ComMeeting API Routes |
|---------------------------|
*/
