<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationBootController extends Controller
{
    public function __invoke()
    {
        return view('backend.layouts.app');
    }
}
