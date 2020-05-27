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

$users = [
    'users' => [
        ['id' => 0, 'name' => 'Adam', 'age' => 39],
        ['id' => 'ABC', 'name' => 'Sigrid', 'age' => 12],
        ['id' => 22, 'name' => 'Tomas', 'age' => 88]
    ]
];

Route::get('/', function () {
    return view('index');
});

Route::get('/users/{username}', function ($username) use ($users) {

    $user = array_values(array_filter($users['users'], function ($user) use ($username) {
        return $user['name'] == $username;
    }));

    if (count($user) == 1) {
        return view('users', ['user' => $user[0]]);
    } else {
        return view('users', ['error' => 'Det finns ingen användare med det namnet.']);
    }
});

Route::get('/users', function () use ($users) {

    return view('users', ['users' => $users['users']]);
});
