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


/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); */

Route::group(['middleware' => ['web']], function(){

    Route::get('/', 'PageController@home')->name('home');
    Route::get('/competition', 'CompetitionController@index')->name('competition');
    Route::get('/users', 'UserController@showAllUsers')->name('users');
    Route::get('/banned', 'UserController@banned')->name('banned');
    Route::get('/user/{user}', 'UserController@show')->name('profile');
    Route::get('/leaderboard', 'PageController@leaderboard');
    Route::get('/competition/{competition}/leaderboard', 'CompetitionController@showLeaderboard');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::auth();

});

Route::group(['middleware' => ['web', 'auth']], function(){

    Route::get('/participate/{competition}/create', 'ParticipationController@create');
    Route::post('/participate/{competition}', 'ParticipationController@store');
    Route::post('/participate/{competition}/team', 'ParticipationController@team');
    Route::get('/participate/{competition}/teamParticipate', 'ParticipationController@teamParticipate');
    Route::get('/participate/{competition}/teamParticipate/register', 'ParticipationController@register');
    Route::get('/participate/{competition}/teamParticipate/login', 'ParticipationController@login');
    Route::post('/participate/{competition}/teamParticipate/registerTeam', 'ParticipationController@registerTeamParticipation');
    Route::post('/participate/{competition}/teamParticipate/loginTeam', 'ParticipationController@loginTeamParticipation');

    Route::get('/competition/{competition}', 'CompetitionController@show');
    Route::get('/competition/{competition}/challenge/{challenge}', 'CompetitionController@showChallenge');
    Route::put('/competition/{competition}/challenge/{challenge}', 'CompetitionController@submitChallenge');
    Route::get('/competition/{competition}/challenge/{challenge}/hint/{hint}', 'Used_HintController@freeHint');
    Route::get('/competition/{competition}/challenge/{challenge}/hint/{hint}/team', 'Used_HintController@freeHintTeam');

});

Route::group(['middleware' => ['web', 'auth', 'admin']], function(){

    Route::get('/admin', 'PageController@admin');
    Route::put('/admin/headLineCompetition', 'PageController@headLineCompetition');
    Route::resource('/admin/category', 'Admin\CategoryController');
    Route::resource('/admin/competition', 'Admin\CompetitionController');
    Route::resource('/admin/challenge', 'Admin\ChallengeController');
    Route::resource('/admin/hint', 'Admin\HintController');
    Route::put('/admin/user/banned', 'Admin\UserController@bannedUser');
    Route::put('/admin/user/unbanned', 'Admin\UserController@unBannedUser');
    Route::put('/admin/competition/{competition}/activate', 'Admin\CompetitionController@activate');
    Route::put('/admin/competition/{competition}/deactivate', 'Admin\CompetitionController@deactivate');
    Route::put('/admin/competition/{competition}/hide', 'Admin\CompetitionController@hide');
    Route::put('/admin/competition/{competition}/unhide', 'Admin\CompetitionController@unhide');
    Route::put('/admin/competition/{competition}/challenge/{challenge}/hide', 'Admin\CompetitionController@editChallengeHide');
    Route::put('/admin/competition/{competition}/challenge/{challenge}/unhide', 'Admin\CompetitionController@editChallengeUnHide');
    Route::put('/admin/competition/{competition}/challenge', 'Admin\CompetitionController@addChallenge');
    Route::delete('/admin/competition/{competition}/challenge/{challenge}', 'Admin\CompetitionController@deleteChallenge');
    Route::delete('/admin/challenge/{challenge}/delete', 'Admin\ChallengeController@destroy');
    Route::delete('/admin/category/{category}/delete', 'Admin\CategoryController@destroy');
    Route::delete('/admin/competition/{competition}/delete', 'Admin\CompetitionController@destroy');
    Route::delete('/admin/hint/{competition}/delete', 'Admin\HintController@destroy');
});

