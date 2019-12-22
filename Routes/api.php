<?php

Route::get('all/{event}', 'ApiController@all')->middleware('auth.basic.once.api:company');
Route::get('/download/{event}', 'ApiController@download')->middleware('auth.basic.once.api:company');


