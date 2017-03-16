<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TopController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function showTop(){
        return view('top');
    }


    function showCreateRoom(){
        return view('createroom');
    }

    function createRoom(Request $r)
    {
        $room_id = 0;

        while (true) {
            $room_id = $this->makeRandStr(25);
            $cnt = DB::table('rooms')->where('room_id', $room_id)->where('delete_flag', '0')->count();

            if($cnt == 0){
                break;
            }
        }

        DB::table('rooms')->insert(
            ['room_id' => $room_id , 'lat' => $r->lat, 'lon' => $r->lon]
        );

        return view('roomshare', compact('room_id'));
    }

    /**
     * ランダム文字列生成 (英数字)
     * $length: 生成する文字数
     */
    function makeRandStr($length) {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;

    }

}
