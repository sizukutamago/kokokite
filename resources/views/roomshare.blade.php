@extends('layout.app')

@section('content')
    {{ Request::root() }}/{{ $room_id }}

    <a href="{{ Request::root() }}/{{ $room_id }}">部屋に移動</a>
@endsection

@section('end_script')

@endsection