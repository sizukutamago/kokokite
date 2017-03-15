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


    function createRoom(){
        return view('createroom');
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

        while (true) {
            $room_id = $this->makeRandStr(25);
        }
    }

}
