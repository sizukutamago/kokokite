@extends('layout.app')

@section('start_script')
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
@endsection

@section('content')

    <div id="map"></div>

    <div class="chat">
        <input type="button" value="push" onclick='push()'>
        <ul id="messages"></ul>
    </div>

@endsection


@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script src="js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        //Pusherキー
        var pusher = new Pusher( '{{ env('PUSHER_KEY') }}' , {
            encrypted: true
        });

        console.log('test');

        //LaravelのEventクラスで設定したチャンネル名
        var channel = pusher.subscribe('{{ $id }}');

        //Laravelのクラス
        channel.bind('App\\Events\\PusherEvent', addMessage);

        function addMessage(data) {
            console.log('a');
            $('#messages').prepend(data.location);
        }

        function push(){
            $.get('/{{ $id }}/pusher');
        }
    </script>
@endsection