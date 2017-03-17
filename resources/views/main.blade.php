@extends('layout.app')

@section('start_script')
    <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
@endsection

@section('content')

    <div class="box_area">
        <div class="box">
            <div id="map"></div>

            <div>
                <input id="maigo" type="button" value="迷子の人は押してね!" onclick="start()">
                <a href="/{{ $id }}/done"><input type="button" value="案内完了!"></a>
            </div>

            <div class="chat">
                <ul id="messages"></ul>
            </div>
            <div>
                <div id="error_message"></div>
                <input type="text" value="" id="chatText" >
                <input type="button" value="送信" onclick='push_chat()'>

            </div>
        </div>
    </div>
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

        var pusher2 = new Pusher( '{{ env('PUSHER_KEY') }}' , {
            encrypted: true
        });

        //LaravelのEventクラスで設定したチャンネル名
        var channel = pusher.subscribe('{{ $id }}');

        //LaravelのEventクラスで設定したチャンネル名
        var channel2 = pusher2.subscribe('{{ $id }}');

        //Laravelのクラス
        channel.bind('App\\Events\\PusherEvent', addMarker);

        channel2.bind('App\\Events\\ChatEvent', addChat);

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

        function push_chat() {

            var chat = document.getElementById('chatText').value;
            if(chat == ''){
                document.getElementById('error_message').innerHTML = '入力してね';
            }else {
                document.getElementById('error_message').innerHTML = '';
                document.getElementById('chatText').value = '';

                $.get(
                        "/{{ $id }}/chat",
                        {
                            "chat": chat
                        }
                );
            }
        }

        function addMarker(data) {

            if($('#maigo') != null)
            {
                $('#maigo').remove();
            }

            var lat = data['location']["lat"];

            var lng = data['location']["lng"];

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

        function addChat(data) {
            $('#messages').prepend('<li id="balloon-5-bottom-right">' + data.chat + '</li>');
            $('#messages').prepend('<div style="clear: both; height: 3px"></div>');
        }

    </script>
@endsection