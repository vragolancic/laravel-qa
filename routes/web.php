<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'QuestionsCotroller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsCotroller')->except('show');
Route::get ('/questions/{slug}', 'QuestionsCotroller@show')->name('questions.show');

//Route::post ('/questions/{questions}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController');
Route::post ('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

Route::post ('/questions/{question}/vote', 'VoteQuestionController');
Route::post ('/answers/{answer}/vote', 'VoteAnswerController');