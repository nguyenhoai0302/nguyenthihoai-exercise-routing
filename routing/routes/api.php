<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user') -> group(function(){
    Route::get('/', function () {
        global $users;
        return $users;
    });

    Route::get('/{id?}', function ($id=null) { 
        global $users;
        if (isset($users[$id])) {
            return $users[$id];
        } else {
            return 'Cannot find the user with index '.$id;
        }
    })->whereNumber('id');

    Route::get('/{name}', function($name){
        global $users;
        foreach ($users as $user){
            if ($name == $user['name']){
                return $user;
            }
            else{
                return "Cannot find the user with name ". $name;
            }
        }
    })->whereAlpha('name');

    Route::fallback(function(){
        return "You cannot get a user like this !";
    });

    Route::get('/{userIndex}/post/{postIndex}', function($userIndex, $postIndex){
        global $users;
        if (isset($users[$userIndex])){
            $user = $users[$userIndex];
            if (isset($user['posts'][$postIndex])){
                return $user['posts'][$postIndex];
            }
            else {
                return "Cannot find the post with id " . $postIndex . " for user " . $userIndex;
            }
        }
    })->where(['userIndex', 'postIndex']);
});





