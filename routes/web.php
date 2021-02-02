<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::prefix('feed/{language}')->group(function () {
    Route::get('', 'FeedController@index')->name('feed');
    Route::get('channel/{channel}', 'FeedController@index')->name('feed.channel');
    Route::get('verify', 'FeedController@verify')->name('feed.verify');
    Route::get('picture/{id}', 'FeedController@propertyPicture')->name('feed.property.picture');
    Route::get('picture/{id}/{width}', 'FeedController@propertyPicture')->name('feed.property.picture.small');
    Route::get('demo/{id}', 'FeedController@demo')->name('feed.demo');
});

Route::localized(function () {
    Auth::routes(['verify' => true]);
    Route::get('home', 'PublicPageController@index')->name('public.index');
    Route::get('about', 'PublicPageController@about')->name('public.about');
    //Route::get('price', 'PublicPageController@price')->name('public.price');
    //Route::get('buy/{id}', 'PublicPageController@buy')->name('public.buy')->middleware('verified');
    //Route::get('contact', 'PublicPageController@contact')->name('public.contact');

    Route::prefix('properties')->group(function () {
        Route::get('/', 'PropertyController@index')->name('properties.index');
        Route::get('search', 'PropertyController@search')->name('properties.search');
        Route::get('{country}', 'PropertyController@country')->name('properties.country');
        Route::get('{country}/{city}/list', 'PropertyController@city')->name('properties.city');
        Route::get('{country}/{city}/{district}/list', 'PropertyController@district')->name('properties.district');
        Route::get('{country}/{city}/{district}/{id}', 'PropertyController@show')->name('properties.show')->middleware('verified');;
        Route::get('link/{id}', 'PropertyController@link')->name('properties.link')->middleware('verified');
    });
});
