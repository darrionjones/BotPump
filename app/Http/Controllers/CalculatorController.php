<?php

namespace App\Http\Controllers;

class CalculatorController extends Controller
{
    //
    function shortBot() {
        return view('pages.calculator.shortbot');
    }

    function longBot() {
        return view('pages.calculator.longbot');
    }
}
