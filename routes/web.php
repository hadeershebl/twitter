<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Route::get('/',['middleware' => 'guest', function()
{
    // Redirected If Authenticated
    return view('auth/login');
}]);

//------------------Authentication Routs for regular users and admins----------------------
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
   
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');

Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

//------------------------------------------------------------------------------------------

Route::view('/home', 'home')->middleware('auth');
    
Route::view('/admin', 'admin/admin');

Route::get('/user/manageProfile/{userId}', 'UserController@manageProfile')->middleware('auth')->name('manageProfile');

Route::post('/user/manageProfile/edite/{id}/att/{flag}', 'UserController@editProfileInfo')->middleware('auth')->name('editProfileInfo');

Route::post('/user/addNewTweet/{ownerid}', 'TweetController@add')->name('addNewTweet');

Route::get('/showMyTweets/{id}', 'TweetController@showOwnerTweets')->name('showMyTweets');

Route::delete('/deleteTweet/{id}','TweetController@destroy')->name('deleteTweet');

Route::get('/editTweet/{tweetId}','TweetController@showSpecificTweet')->name('showSpecificTweet');

Route::post('/updateTweet/{tweetId}','TweetController@update')->name('updateTweet');

Route::get('/explore/{id}', 'UserController@showUsers')->name('showUsers');

Route::get('/explore/specific/{userId}', 'UserController@show_specific_user_profile')->name('show-specific-user-profile');

Route::get('/explore/specific/follow/{followingUserId}' , 'FollowingController@follow')->name('follow');

Route::delete('/explore/specific/unfollow/{unfollowingUserId}','FollowingController@unfollow')->name('unfollow');

Route::get('/like/{tweetId}','TweetController@like')->name('likeTweet');

Route::delete('/unlike/{tweetId}','TweetController@unlike')->name('unlikeTweet');