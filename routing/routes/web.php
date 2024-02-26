<?php

use Illuminate\Support\Facades\Route;
use App\Models\Fruit;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    global $users;
    return $users;
});

Route::get('/users', function () {
    global $users;
    $userNames = array_column($users, 'name');
    return 'The users are: '. implode(', ', $userNames);
});

Route::get('myview/{user}', function ($user){
    return view('home', ['username' => $user]);
    return view('home', ['username' => 'rady', 'age' => 99]);
});



