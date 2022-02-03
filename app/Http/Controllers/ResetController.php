<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Artisan;

class ResetController extends Controller
{
    //
    public function reset() {
        Artisan::call('migrate:fresh');
        return "Ok";
    }
}
