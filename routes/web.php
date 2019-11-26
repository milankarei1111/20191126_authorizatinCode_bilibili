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

// $ php artisan passport:client 設定的值
$clientId = 3;
$clientSecret = 'MFUo1AcSf2mM8dMXUxrDjr11NO37FwtwxyNq3Vr4';

// bili登入頁面
Route::view('/login', 'auth.login');

// 第三方登入重定向
Route::get('lishen/login',
    function (\Illuminate\Http\Request $request) use ($clientId) {
        $request->session()->put('state', $state = \Illuminate\Support\Str::random(40));

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => 'http://localhost:9987/auth/callback',
            'response_type' => 'code',
            'scope' => '*',
            'state' => $state,
        ]);

        return redirect('http://localhost:9988/oauth/authorize?'.$query);
});
