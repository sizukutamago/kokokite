
// キャンパスの要素を取得する
var canvas = document.getElementById( 'map' ) ;

// 中心の位置座標を指定する
var latlng = new google.maps.LatLng( lat, lon );

// 地図のオプションを設定する
var mapOptions = {
    zoom: 15 ,	// ズーム値
    center: latlng 	// 中心座標 [latlng]
};

// [canvas]に、[mapOptions]の内容の、地図のインスタンス([map])を作成する
var map = new google.maps.Map( canvas, mapOptions ) ;

//マーカーオプション
var markerOptions = {
    map: map,
    position: latlng
};

var marker = new google.maps.Marker(markerOptions);

var lastTime;

var maigo_marker = null;

function start() {

    // ユーザーの端末がGeoLocation APIに対応しているかの判定
    // 対応している場合
    if (navigator.geolocation) {

        //getCurrentPositionのオプション設定
        var optionObj = {
            "enableHighAccuracy": false,
            "timeout": 8000,
            "maximumAge": 5000,
        };


        // 現在位置を取得する
        navigator.geolocation.watchPosition(successFunc, errorFunc, optionObj);


        //対応してない場合
    } else {
        // エラーメッセージ
        var errorMessage = "お使いの端末は、GeoLacation APIに対応していません。";

        // アラート表示
        alert(errorMessage);
    }

}

//現在位置の取得に成功した時
function successFunc(position) {

    console.log('s');

    // データの更新
    var nowTime = ~~(new Date() / 1000); // UNIX Timestamp

    // 前回の書き出しから3秒以上経過していたら描写
    // 毎回HTMLに書き出していると、ブラウザがフリーズするため
    if ((lastTime + 3) > nowTime) {
        return false;
    }

    // 前回の時間を更新
    lastTime = nowTime;

    // 取得したデータの整理
    var data = position.coords;

    // データの整理
    var lat = data.latitude; //緯度
    var lng = data.longitude; //経度

    push_latlng(lat, lng);

}

//現在位置の取得に失敗した時
function errorFunc(error) {

    // エラーコードのメッセージを定義
    var errorMessage = {
        0: "原因不明のエラーが発生しました…。",
        1: "位置情報の取得が許可されませんでした…。",
        2: "電波状況などで位置情報が取得できませんでした…。",
        3: "位置情報の取得に時間がかかり過ぎてタイムアウトしました…。",
    };

    // エラーコードに合わせたエラー内容をアラート表示
    alert(errorMessage[error.code]);
}


