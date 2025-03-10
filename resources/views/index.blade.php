@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    index aa

    @if(thisAuth()->check())
        <button onclick="logout();">로그아웃</button>
    @endif
@endsection

@section('addScript')
@endsection
