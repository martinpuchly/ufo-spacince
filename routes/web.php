<?php

use App\Player;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');

    #USERS
    Route::get('/uzivatelia', 'UserController@index')->name('admin.users')->middleware('can:viewAdminList,App\User');
    Route::delete('/uzivatelia/{user}/vymazat', 'UserController@delete')->name('admin.user.delete')->middleware('can:delete,user');

    #GROUPS
    Route::get('/skupiny', 'GroupController@index')->name('admin.groups')->middleware('can:viewAny,App\Group');
    Route::post('/skupiny/pridat', 'GroupController@store')->name('admin.group.add')->middleware('can:create,App\Group');
    Route::get('/skupiny/{group}/upravit', 'GroupController@edit')->name('admin.group.edit')->middleware('can:update,group');
    Route::patch('/skupiny/{group}/upravit', 'GroupController@update')->middleware('can:update,group');
    Route::delete('/skupiny/{group}/vymazat', 'GroupController@delete')->name('admin.group.delete')->middleware('can:delete,group');

    #GROUPS -> USER
    Route::get('/skupiny/uzivatel/{user}', 'GroupController@user')->name('admin.groups.user')->middleware('can:setGroup,user');
    Route::patch('/skupiny/uzivatel/{user}', 'GroupController@userUpdate')->middleware('can:setGroup,user');

    #PERMISSIONS
    Route::get('/povolenia', 'PermissionController@index')->name('admin.permissions')->middleware('can:any,App\Permission');
    Route::post('/povolenia/pridat', 'PermissionController@store')->name('admin.permission.add')->middleware('can:any,App\Permission');
    Route::get('/povolenia/{permission}/upravit', 'PermissionController@edit')->name('admin.permission.edit')->middleware('can:any,App\Permission');
    Route::patch('/povolenia/{permission}/upravit', 'PermissionController@update')->middleware('can:any,App\Permission');
    Route::delete('/povolenia/{permission}/vymazat', 'PermissionController@delete')->name('admin.permission.delete')->middleware('can:any,App\Permission');


    #TEAMS
    Route::get('/timy', 'TeamController@index')->name('admin.teams')->middleware('can:any,App\Team');
    Route::post('/timy/pridat', 'TeamController@store')->name('admin.team.add')->middleware('can:any,App\Team');
    Route::get('/timy/{team}/upravit', 'TeamController@edit')->name('admin.team.edit')->middleware('can:any,App\Team');
    Route::patch('/timy/{team}/upravit', 'TeamController@update')->middleware('can:any,App\Team');
    Route::delete('/timy/{team}/vymazat', 'TeamController@delete')->name('admin.team.delete')->middleware('can:any,App\Team');



    #PERMISSIONS -> USER
    Route::get('/povolenia/uzivatel/{user}', 'PermissionController@user')->name('admin.permissions.user')->middleware('can:setPermission,user');
    Route::patch('/povolenia/uzivatel/{user}', 'PermissionController@userUpdate')->middleware('can:setPermission,user');

    #PERMISSIONS -> GROUP
    Route::get('/povolenia/skupina/{group}', 'PermissionController@group')->name('admin.permissions.group')->middleware('can:setPermission,group');
    Route::patch('/povolenia/skupina/{group}', 'PermissionController@groupUpdate')->middleware('can:setPermission,group');

    #PLAYERS
    Route::get('/hraci', 'PlayerController@index')->name('admin.players')->middleware('can:adminIndex,App\Player');
    Route::get('/hraci/vytvorit/{user}', 'PlayerController@create')->name('admin.player.add')->middleware('can:adminCreate,App\Player');
    Route::post('/hraci/vytvorit/{user}', 'PlayerController@store')->name('admin.player.add')->middleware('can:adminCreate,App\Player');
    Route::get('/hrac/upravit/{player}', 'PlayerController@edit')->name('admin.player.edit')->middleware('can:adminUpdate,player');
    Route::patch('/hrac/upravit/{player}', 'PlayerController@update')->middleware('can:adminUpdate,player');
    Route::delete('/hrac/vymazat/{player}', 'PlayerController@delete')->name('admin.player.delete')->middleware('can:adminDelete,player');
});



#PLAYERS
Route::get('/hrac/vytvorit', 'PlayerController@create')->name('player.add')->middleware('can:create,App\Player');
Route::post('/hrac/vytvorit', 'PlayerController@store')->middleware('can:createUser,App\Player');
Route::get('/hrac/upravit', 'PlayerController@edit')->name('player.edit')->middleware('can:update,App\Player');
Route::patch('/hrac/upravit', 'PlayerController@update')->middleware('can:update,App\Player');
Route::delete('/hrac/vymazat', 'PlayerController@delete')->name('player.delete')->middleware('can:delete,App\Player');
