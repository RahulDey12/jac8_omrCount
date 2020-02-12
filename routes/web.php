<?php

    Route::get('/', "PageController@index");
    Route::post('/submit', "PageController@submitData")->name('main-page');
