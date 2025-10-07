<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post', function () {
    return Auth::user() ? true  : false ;
});
