@extends('layout.app')

@section('content')

    <div class="box_area">
        <div class="box">

            <h3>このURLを案内したい人に共有してください</h3>

            <!-- コピー対象 -->
            <input id="foo" value="{{ Request::root() }}/{{ $room_id }}" size="60">

            <br>
            <!-- コピーボタン -->
            <button class="btn button" data-clipboard-target="#foo">
                クリップボードにコピー
            </button>

            <br>

            <a class="button" href="{{ Request::root() }}/{{ $room_id }}">部屋に移動</a>
        </div>
    </div>
@endsection

@section('end_script')

@endsection