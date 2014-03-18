<?php

// only for development
Auth::loginUsingId(1);

Route::resource('users', 'UsersController', ['only' => ['edit', 'update']]);
