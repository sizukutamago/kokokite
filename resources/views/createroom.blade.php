@extends('layout.app')

@section('content')
    <div class="box_area">
        <div class="box">
            <p class="room_title">集合場所を選択</p>

            <div id="map" class="map"></div>

            <input id="get_current_location" type="button" value="現在地" onclick="get_current_location()">

            <div id="error_message"></div>
            <div name="search1">
                <dl class="search1">
                    <dt><input type="text" id="get_address" name="search" value="" placeholder="場所名を入力..." /></dt>
                    <dd><button id="get_address_location" onclick="codeAddress()"><span>検索</span></button></dd>
                </dl>
            </div>
            <form id="room_form" action="/create_room" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="lat" id="lat" value="">
                <input type="hidden" name="lon" id="lon" value="">
            </form>
        </div>
    </div>
@endsection

@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script src="js/app.js"></script>
@endsection