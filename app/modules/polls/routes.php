<?php
/*Admin routes*/
Route::pattern('id', '[0-9]+');
Route::get('polls/vote', 'App\Modules\Polls\Controllers\PollsController@getPoll');
Route::post('polls/vote', 'App\Modules\Polls\Controllers\PollsController@postPoll');


Route::group(array('prefix' => 'admin', 'before' => 'auth|detectLang'), function()
{
	Route::get('polls', 'App\Modules\Polls\Controllers\AdminPollController@getIndex');
		
	Route::get('polls/install', 'App\Modules\Polls\Controllers\InstallPollController@getInstall');
   	Route::post('polls/install', 'App\Modules\Polls\Controllers\InstallPollController@postInstall');
   	Route::get('polls/uninstall', 'App\Modules\Polls\Controllers\InstallPollController@getUninstall');
   	Route::post('polls/uninstall', 'App\Modules\Polls\Controllers\InstallPollController@postUninstall');
	
	Route::get('polls/{id}/edit', 'App\Modules\Polls\Controllers\AdminPollController@getEdit');
    Route::post('polls/{id}/edit', 'App\Modules\Polls\Controllers\AdminPollController@postEdit');
    Route::get('polls/{id}/delete', 'App\Modules\Polls\Controllers\AdminPollController@getDelete');
    Route::post('polls/{id}/delete', 'App\Modules\Polls\Controllers\AdminPollController@getDelete');
	Route::get('polls/{id}/deleteitem', 'App\Modules\Polls\Controllers\AdminPollController@postDeleteItem');
    Route::post('polls/{id}/deleteitem', 'App\Modules\Polls\Controllers\AdminPollController@postDeleteItem');
	
	Route::get('polls/{id}/change', 'App\Modules\Polls\Controllers\AdminPollController@getChange');
    Route::get('polls/{id}/results', 'App\Modules\Polls\Controllers\AdminPollController@getResults');
	
    Route::controller('polls', 'App\Modules\Polls\Controllers\AdminPollController');
	
});
