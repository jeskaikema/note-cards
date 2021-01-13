<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');                                                     //Send user to dashboard (index page)
Route::get('/home', 'HomeController@index')->name('dashboard');                                             //Send user to dashboard (index page)

Route::get('/logout', 'Auth\LoginController@logout');                                                              //Logout

Route::group(['prefix' => 'cards'], function () {
    Route::get('/create', 'CardController@create')->name('create.card');                                    //Create a new card
    Route::post('/store', 'CardController@store')->name('store.card');                                      //Save a new card

    Route::get('/trash', 'CardController@trash')->name('trash.card');                                       //See soft deleted cards
    Route::get('/remove/{card}', 'CardController@softdelete')->name('remove.card');                         //Soft delete a card
    Route::get('/delete/{card}', 'CardController@destroy')->name('delete.card');                            //Delete card from db permanently

    Route::get('/edit/{card}', 'CardController@edit')->name('edit.card');                                   //Edit the selected card
    Route::patch('/update/{card}', 'CardController@update')->name('update.card');                           //Save card edits

    Route::get('/finished', 'CardController@finished')->name('finished.card');                              //See finished cards
    Route::get('/finish/{card}', 'CardController@finish')->name('finish.card');                             //Add card to finished

    Route::get('/restore/{card}', 'CardController@restore')->name('restore.card');                          //Restore soft deleted cards
    Route::get('/swapstatus/{card}', 'CardController@swapStatus')->name('swap.card.status');                //Swap between waiting and active
    Route::get('/choosestatus/{card}/{status}', 'CardController@chooseStatus')->name('choose.card.status'); //Choose the cards status
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/profile/{user}', 'UserController@show')->name('user.profile');                             //See user profile
    Route::patch('/update/{user}', 'UserController@update')->name('update.profile');                        //Save profile changes
});
