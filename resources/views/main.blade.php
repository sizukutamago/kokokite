@extends('layout.app')

@section('start_script')
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
@endsection

@section('content')

    <div id="map">

    </div>

    <div class="chat">

    </div>

@endsection


@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script src="js/app.js"></script>
@endsection