<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('post', function ($user) {
    return true;
});
