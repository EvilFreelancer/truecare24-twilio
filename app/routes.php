<?php

/**
 * All routes will be here
 */

$app->get('/', \App\Controllers\Call::class . ':index');
$app->post('/call', \App\Controllers\Call::class . ':call');
