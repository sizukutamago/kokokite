@extends('layout.app')

@section('content')
    <p>集合場所を選択</p>

    <div id="map"></div>

    <input id="get_current_location" type="button" value="現在地を集合場所に" onclick="get_current_location()">

    <div id="error_message"></div>
    <input id="get_address" type="text">
    <input id="get_address_location" type="button" value="ここ" onclick="codeAddress()">

    <form id="room_form" action="/create_room" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="lat" id="lat" value="">
        <input type="hidden" name="lon" id="lon" value="">
    </form>
@endsection

@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script src="js/app.js"></script>
@endsection