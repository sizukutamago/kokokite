<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PusherEvent;

class MainController extends Controller
{
    function showMain($id){
        return view('main', compact('id'));
    }

    function push($id){
        event(new PusherEvent('こんにちわ!', $id));
    }
}
