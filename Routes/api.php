<?php

Route::get('check/{event}', function(){
	return response('dsa', 202);
})->middleware('auth.basic.once.api:company');
Route::get('all/{event}', 'ApiController@all')->middleware('auth.basic.once.api:company');
Route::get('/download/{event}', 'ApiController@download')->middleware('auth.basic.once.api:company');

Route::post('pos/{event}', 'ApiController@pos')->middleware('auth.basic.once.api:company');


