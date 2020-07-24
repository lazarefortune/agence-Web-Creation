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


Auth::routes();


// *** ROUTES VISITEUR*** //



  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/demande-de-devis', function(){
    return view('formulaire');
  });



// AUTRES ROUTES SANS LOGIN //

  Route::get('/boutique', function(){
    return "Boutique";
  });


  // streaming without login
  Route::prefix('streaming')->name('streaming.')->group(function() {

  Route::post('/login', 'StreamingController@login')->name('login');
  Route::post('/logout', 'StreamingController@logout')->name('logout');

  });
  //  streaming with login
  Route::prefix('streaming')->name('streaming.')->group(function() {

    Route::get('/my-orders', 'StreamingController@account')->name('account')->middleware('auth');
    Route::delete('/delete/{id_forfait}', 'StreamingController@deleteForfait')->name('deleteForfait');
    Route::get('/', 'StreamingController@index')->name('index');
//    paiement
    Route::get('/payment/{stream}', 'StreamingController@payment')->name('payment')->middleware('auth');
    Route::get('/payment/{stream}/proof-of-payment', 'StreamingController@payment_proof')->name('payment-proof')->middleware('auth');
    Route::post('/payment/{stream}/proof-of-payment', 'StreamingController@payment_proof_store')->name('payment-proof-store')->middleware('auth');
    Route::get('/payment/{stream}/payment_success', function(){
      return view('streaming.payment_success');
    })->middleware('auth');

    Route::get('/help' , function(){
      return view('streaming.help');
    })->name('help')->middleware('auth');
  

    Route::get('/login', function(){
      return view('streaming.login');
    })->name('loginView');

    Route::post('/forfait/{id_forfait}', 'StreamingController@store_netflix')->name('store')->middleware('auth');

    Route::get('/facture/{stream}', 'StreamingController@getFacturePdf')->name('facture');
  });


// *** ROUTES AVEC LOGIN *** //

  Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {

    Route::resource('users', 'UsersController');
    Route::get('home', 'AdminController@home')->name('home');
    Route::get('streaming/forfaits', 'ForfaitController@index')->name('streaming.forfaits');
    Route::get('streaming/add-forfait', 'ForfaitController@create')->name('streaming.create-forfait');
    Route::post('streaming/add-forfait', 'ForfaitController@store')->name('streaming.store-forfait');

    Route::get('streaming/edit-forfait/{forfait}', 'ForfaitController@edit')->name('streaming.edit-forfait');
    Route::post('streaming/update-forfait/{forfait}', 'ForfaitController@update')->name('streaming.update-forfait');

    Route::delete('streaming/delete-forfait/{forfait}', 'ForfaitController@destroy')->name('streaming.delete-forfait');

    Route::get('streaming/command-list', 'ForfaitController@command_list')->name('streaming.command_list');
    Route::get('streaming/confirm-payment-proof/{stream}', 'ForfaitController@confirm_payment_proof')->name('streaming.confirm_payment_proof');
    Route::get('streaming/reject-payment-proof/{stream}', 'ForfaitController@reject_payment_proof')->name('streaming.reject_payment_proof');

  });

  Route::group([
    'middleware' => 'auth'
  ], function(){


    Route::get('/account', '\App\Http\Controllers\UserController@edit')->name('account');
    Route::post('/account', '\App\Http\Controllers\UserController@update')->name('account.update');
    Route::post('/account/password_update', '\App\Http\Controllers\UserController@update_password')->name('account.password.update');

    Route::get('/client-area', 'ClientController@client_area')->name('client.area');

  });

  Route::prefix('forum')->name('forum.')->group(function() {

    Route::get('/', 'TopicController@index')->name('topics.index');
    Route::resource('topics', 'TopicController')->except(['index']);
    Route::get('showFromNotification/{topic}/{notification}', 'TopicController@showFromNotification')->name('topics.showFromNotification');
    Route::post('/comments/{topic}', 'CommentController@store')->name('comments.store');
    Route::post('/commentReply/{comment}', 'CommentController@storeCommentReply')->name('comments.storeReply');
    Route::post('/markedAsSolution/{topic}/{comment}', 'CommentController@markedAsSolution')->name('comments.markedAsSolution');
    Route::get('/my-topics', 'TopicController@myTopics')->name('topics.myTopics');

  });

  // Mon Bon Coin

  Route::prefix('monboncoin')->name('monboncoin.')->group(function() {

    Route::get('/my-ads', 'HomeController@my_ads')->name('my-ads');

    Route::get('/messages', 'HomeController@messages_monboncoin')->name('messages');

    /* Ads Routes */
    Route::get('/', 'AdController@index')->name('ads.index');
    Route::get('/annonce/create', 'AdController@create')->name('ads.create');
    Route::post('/annonce/create', 'AdController@store')->name('ads.store');
    Route::get('/annonce/{id}', 'AdController@show')->name('ads.show');

    Route::get('/annonce/{id}/edit', 'AdController@edit')->name('ads.edit');

    Route::delete('/annonce/{id}', 'AdController@destroy')->name('ads.destroy');

    Route::post('/annonce/{id}/update', 'AdController@update')->name('ads.update');

    /* Searches Routes */
    Route::patch('/search', 'SearchController@index')->name('search.index');

    /* Contact Routes */
    Route::get('/contact/{seller_id}/{ad_id}', 'ContactController@index')->name('contact.index');
    Route::post('/contact', 'ContactController@store')->name('contact.store');

  });

  Route::get('/hello', function(){
    return view('hello');
  });
