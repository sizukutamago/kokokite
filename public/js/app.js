// キャンパスの要素を取得する
var canvas = document.getElementById( 'map' ) ;


// 中心の位置座標を指定する
var latlng = new google.maps.LatLng( 35.792621, 139.806513 );

// 地図のオプションを設定する
var mapOptions = {
    zoom: 15 ,	// ズーム値
    center: latlng 	// 中心座標 [latlng]
};

// [canvas]に、[mapOptions]の内容の、地図のインスタンス([map])を作成する
var map = new google.maps.Map( canvas, mapOptions ) ;

var marker = null;

//現在地取得
function get_current_location()
{
    // Geolocation APIに対応している
    if( navigator.geolocation )
    {

        //getCurrentPositionのオプション設定
        var optionObj = {
            "enableHighAccuracy": true,
            "timeout": 10000,
            "maximumAge": 5000,
        };

        // 現在位置を取得できる場合の処理
        // 現在位置を取得する
        navigator.geolocation.getCurrentPosition( successFunc , errorFunc , optionObj ) ;

    }

// Geolocation APIに対応していない
    else
    {
        // 現在位置を取得できない場合の処理
        alert( "あなたの端末では、現在位置を取得できません。" ) ;
    }

}

// 成功した時の関数
function successFunc( position )
{

    if(marker === null){

        marker = new google.maps.Marker( {
            map: map ,	// 地図
            position: new google.maps.LatLng(position.coords.latitude , position.coords.longitude ) 	// 位置座標
        } ) ;

        addFormSubmit(position.coords.latitude , position.coords.longitude);

    }else {
        marker.setPosition(new google.maps.LatLng(position.coords.latitude , position.coords.longitude) );
    }

    map.setCenter(new google.maps.LatLng(position.coords.latitude , position.coords.longitude) );

}

// 失敗した時の関数
function errorFunc( error )
{
    // エラーコードのメッセージを定義
    var errorMessage = {
        0: "原因不明のエラーが発生しました…。" ,
        1: "位置情報の取得が許可されませんでした…。" ,
        2: "電波状況などで位置情報が取得できませんでした…。" ,
        3: "位置情報の取得に時間がかかり過ぎてタイムアウトしました…。" ,
    } ;

    // エラーコードに合わせたエラー内容をアラート表示
    alert( errorMessage[error.code] ) ;
}

function codeAddress()
{
    var address = document.getElementById("get_address").value;
    if(address == "")
    {
        document.getElementById("error_message").innerHTML = "入力してね";
    } else {
        document.getElementById("error_message").innerHTML = "";

        // google.maps.Geocoder()コンストラクタのインスタンスを生成
        var geocoder = new google.maps.Geocoder();

        console.log(address);

        // geocoder.geocode()メソッドを実行
        geocoder.geocode( { 'address': address, 'region': 'jp' }, function(results, status) {

            // ジオコーディングが成功した場合
            if (status == google.maps.GeocoderStatus.OK) {

                if(marker === null){

                    marker = new google.maps.Marker( {
                        map: map ,	// 地図
                        position: results[0].geometry.location	// 位置座標
                    } ) ;

                }else {
                    marker.setPosition(results[0].geometry.location);
                }

                // google.maps.Map()コンストラクタに定義されているsetCenter()メソッドで
                // 変換した緯度・経度情報を地図の中心に表示
                map.setCenter(results[0].geometry.location);

                addFormSubmit(results[0].geometry.location.lat(), results[0].geometry.location.lng());

                // ジオコーディングが成功しなかった場合
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }

        });
    }
}

function addFormSubmit(lat, lon)
{

    document.getElementById('lat').setAttribute('value', lat);
    document.getElementById('lon').setAttribute('value', lon);

    if(document.getElementById('addSubmit') == null) {

        var input = document.createElement('input');

        input.setAttribute('id', 'addSubmit');
        input.setAttribute('class', 'addButton');
        input.setAttribute('type', 'submit');
        input.setAttribute('value', '部屋を作成');

        document.getElementById('room_form').appendChild(input);
    }
}