<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('admin', 'Auth\LoginController@showLoginForm');

//clear cache
Route::get('clear',function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
      return 'cache and config cleared!';
});

Route::get('/', function () {
   return redirect('/admin/login');
});
