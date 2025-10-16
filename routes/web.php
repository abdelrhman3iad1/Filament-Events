<?php

use Illuminate\Support\Facades\Route;
use App\Events\PostCreated;
use App\Models\Post;
use App\Notifications\PostCreatedNotification;

Route::get('/', function () {
    return redirect('dashboard');
});
