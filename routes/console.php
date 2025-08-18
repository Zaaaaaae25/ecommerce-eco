<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Stay positive and keep coding!');
})->purpose('Display an inspiring quote');
