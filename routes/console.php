<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('laundry:about', function () {
    $this->comment('Kang Laundry order management.');
})->purpose('Display application information');
