<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorMovePageController extends Controller
{
    public function __invoke()
    {

        return view('301');
    }
}
