<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    /**
     * This should verify that the user is not logged
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('landing.index');
    }
}
