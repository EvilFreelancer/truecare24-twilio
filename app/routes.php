<?php

$app->get('/', \App\Controllers\Call::class . ':index');
$app->get('/call', \App\Controllers\Call::class . ':call');
