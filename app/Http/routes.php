<?php

    //play
    Route::controller('/play', 'PlayController');

    // fbcallback
    Route::controller('/fbcallback', 'FacebookController');

    //first access
    Route::controller('/', 'UserController');

