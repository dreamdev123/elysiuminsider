<?php

use Illuminate\Http\Request;

Route::group(['as' => 'api::'], static function () {
    Route::fallback(static function () {
        return response()->json(['exception' => 'Not Allowed'], 405);
    });

    Route::post('scm/callback', ['as' => 'callback', 'uses' => 'Api\SCMCallbackController@callback']);
});


