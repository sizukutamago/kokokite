<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PusherEvent;
use DB;

class MainController extends Controller
{
    function showMain($id)
    {

        $r = DB::table('rooms')->where('room_id', $id)->where('delete_flag', '0')->first();

        if(count($r) == 0){
            return redirect('/');
        }

        $lat = $r->lat;
        $lon = $r->lon;

        return view('main', compact('id', 'lat', 'lon'));
    }

    function push($id)
    {
        event(new PusherEvent('こんにちわ!', $id));
    }

    function push_latlng(Request $r, $id)
    {
        event(new PusherEvent(['lat' => $r->lat, 'lng' => $r->lng], $id));
    }

    function done($id)
    {
        DB::table('rooms')->where('room_id', $id)->where('delete_flag', '0')->update(['delete_flag' => '1']);

        return redirect('/');
    }
}
