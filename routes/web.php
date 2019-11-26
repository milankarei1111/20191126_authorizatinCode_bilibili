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

// 回調地址 獲取code 隨後發出獲取token請求
Route::view('auth/callback', 'auth.callback');

// 獲取token
Route::post('/get/token', function (\Illuminate\Http\Request $request) use (
    $clientId,
    $clientSecret
    ) {

    // csrf 攻擊處理
    $state = $request->session()->pull('state'); // pull 方法從 Session 檢索並删除项目

    // 驗證state
    throw_unless(
        strlen('state') > 0 && $state === $request->params['state'],
        InvalidArgumentException::class
    );

    // 發送http請求
    $response = (new \GuzzleHttp\Client())->post('http://localhost:9988/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => 'http://localhost:9987/auth/callback',
            'code' => $request->params['code'],
        ]
    ]);

    return json_decode($response->getBody(), true);
});

// 刷新token
Route::view('/refresh', 'auth.refresh');


Route::post('/refresh', function (\Illuminate\Http\Request $request) use (
    $clientId,
    $clientSecret
    ) {

    $http = new GuzzleHttp\Client;

    // 發送http請求
    $response = (new \GuzzleHttp\Client())->post('http://localhost:9988/oauth/token', [
        'form_params' => [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->params['refresh_token'],
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        ]
    ]);

    return json_decode($response->getBody(), true);
});
