@extends('layout.app')

@section('content')

    <div class="box_area">

        <div class="box box_img">

            <h1 class="title">kokokite</h1>

            <a href="/create_room" class="button">ルームを作成</a>

            <a class="underarrow" href="#1"><span></span>about me</a>

        </div>

        <div class="box">
            <p class="about">ナビを使っても迷ってしまう</p>
        </div>

        <div class="box">
            <p class="about">そんなあなたや友人のための</p>
        </div>

        <div class="box" id="1">
            <p class="about">ナビ支援サービスです</p>
        </div>


    </div>

    <script type="text/javascript">
        $(function(){
            $('a[href^=#]').click(function(){
                var speed = 9000;
                var href= $(this).attr("href");
                var target = $(href == "#" || href == "" ? 'html' : href);
                var position = target.offset().top;
                $("html, body").animate({scrollTop:position}, speed, "swing");
                return false;
            });
        });
    </script>

@endsection