<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class WebController extends Controller
{
    /**
     * Return view
     *
     * @return void
     */
    public function index(): View
    {
        return view('welcome');
    }
}
