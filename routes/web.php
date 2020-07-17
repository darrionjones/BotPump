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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web', 'auth', /*'isEmailVerified'*/]], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboard/data', 'DashboardController@data')->name('dashboard/data');

    Route::get('/apikey', 'ApiKeyController@index');
    Route::get('/apikey/create', 'ApiKeyController@create');
    Route::post('/apikey/store', 'ApiKeyController@store')->name('apikey/store');

    Route::get('/exchangekey', 'ExchangeKeyController@index');
    Route::get('/exchangekey/create', 'ExchangeKeyController@create');
    Route::post('/exchangekey/store', 'ExchangeKeyController@store')->name('exchangekey/store');

    Route::get('/3commas/loadDeal', 'ThreeCommasController@loadDealFrom3Commas')->name('3commas/loadDeal');
    Route::get('/3commas/loadBots', 'ThreeCommasController@loadBotsFrom3Commas')->name('3commas/loadBots');
    Route::post('/3commas/panicSellDeal/{deal_id}', 'ThreeCommasController@panicSellDeal')->name('3commas/panicSellDeal');
    Route::post('/3commas/cancelDeal/{deal_id}', 'ThreeCommasController@cancelDeal')->name('3commas/cancelDeal');
    Route::post('/3commas/disableBot/{bot_id}', 'ThreeCommasController@disableBot')->name('3commas/disableBot');
    Route::post('/3commas/enableBot/{bot_id}', 'ThreeCommasController@enableBot')->name('3commas/enableBot');
    Route::post('/3commas/startNewDeal/{bot_id}', 'ThreeCommasController@startNewDeal')->name('3commas/startNewDeal');

    Route::get('/profit/date', 'ProfitController@date');
    Route::get('/profit/pair', 'ProfitController@pair');
    Route::get('/profit/bot', 'ProfitController@bot');
    Route::post('/profit/getPairByBase', 'ProfitController@getPairByBase')->name('profit/getPairByBase');
    Route::post('/profit/getBotByBase', 'ProfitController@getBotByBase')->name('profit/getBotByBase');
    Route::post('/profit/getProfitByDate', 'ProfitController@getProfitByDate')->name('profit/getProfitByDate');
    Route::post('/profit/getBasePair', 'ProfitController@getBasePair')->name('profit/getBasePair');

    Route::get('/calculator/longBot', 'CalculatorController@longBot');
    Route::get('/calculator/shortBot', 'CalculatorController@shortBot');

    Route::get('/plan', 'PlanController@index');

    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'UserController@update_avatar');

    Route::get('/basic/bot', 'BotController@index');
    Route::get('/basic/bot/{bot}','BotController@show')
         ->name('basic.bot.show')
         ->where('id', '[0-9]+');

    Route::get('/basic/deal', 'DealController@index');
    Route::get('/basic/deal/{deal}','DealController@show')
         ->name('basic.deal.show')
         ->where('id', '[0-9]+');

    Route::get('register/verify', 'App\Http\Controllers\Auth\RegisterController@verify')->name('verifyEmailLink');
    Route::get('register/verify/resend', 'App\Http\Controllers\Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
    Route::post('register/verify/resend', 'App\Http\Controllers\Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail');

    Route::get('/smartswitch/dual', 'SmartSwitchDualController@index');
    Route::post('/smartswitch/dual/store', 'SmartSwitchDualController@store')->name('smartswitch/dual/store');
    Route::get('/smartswitch/dual/create', 'SmartSwitchDualController@create')->name('smartswitch/dual/create');
    Route::get('/smartswitch/dual/{smart_switch_dual}','SmartSwitchDualController@show')
         ->name('smartswitch.dual.show')
         ->where('id', '[0-9]+');
});

