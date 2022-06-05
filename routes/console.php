<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Test;

/*
  |--------------------------------------------------------------------------
  | Console Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of your Closure based console
  | commands. Each Closure is bound to a command instance allowing a
  | simple approach to interacting with each command's IO methods.
  |
 */


Artisan::command('t', function () {
    $testService = new App\Services\TestService();
    $takedTest = json_decode('{"questions":[{"number":"1","answers":[2]},{"number":"2","answers":[1,2,3]}]}');
    $testService->takeTest($takedTest, intval(1), 1);
});
