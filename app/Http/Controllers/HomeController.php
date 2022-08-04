<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function get()
    {
        return response("OK\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
