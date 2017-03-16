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

    <input type="button" value="迷子の人はこのボタン" onclick="start()">
    <a href="/{{ $id }}/done">案内完了!</a>

@endsection


@section('end_script')
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCxT9dkiWhSWlYtfFxjJDhSUZq6OPUOnRI&libraries=drawing,geometry,places"></script>
    <script>
        var lat = '{{ $lat }}';
        var lon = '{{ $lon }}';
    </script>
    <script src="/js/main.js"></script>
    <script>
        //Pusherキー
        var pusher = new Pusher( '{{ env('PUSHER_KEY') }}' , {
            encrypted: true
        });

        //LaravelのEventクラスで設定したチャンネル名
        var channel = pusher.subscribe('{{ $id }}');

        //Laravelのクラス
        channel.bind('App\\Events\\PusherEvent', addMarker);

        function push(){
            $.get('/{{ $id }}/pusher');
        }

        function push_latlng(lat, lng) {

            $.get(
                    "/{{ $id }}/push",
                    {
                        lat: lat,
                        lng: lng
                    }
            );
        }

        function addMarker(data) {

            var lat = data['location']["lat"];

            var lng = data['location']["lng"];

            console.log('a');

            // 中心の位置座標を指定する
            var latlng = new google.maps.LatLng(lat, lng);

            if(maigo_marker == null) {

                //マーカーオプション
                var markerOptions = {
                    map: map,
                    position: latlng
                };

                // マーカーの新規出力
                maigo_marker = new google.maps.Marker(markerOptions);

            }else{
                // マーカーの場所を変更
                maigo_marker.setPosition(latlng);
            }
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
@endsection