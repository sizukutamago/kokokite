@extends('layout.app')

@section('content')
    <p>集合場所を選択</p>

    <div id="map"></div>

@endsection

@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script src="js/app.js"></script>
@endsection