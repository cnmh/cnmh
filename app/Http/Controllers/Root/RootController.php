<?php

namespace App\Http\Controllers\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RootController extends Controller
{
    public function index()
    {
        return view('root.home');
    }
}
