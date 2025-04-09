@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
        .word-preview {
            text-align: center;
        }

        .word-preview div {
            padding: 50px;
            margin-bottom: 100px;
            border: 1px solid black;
        }

        .word-preview div P {
            margin: 10px;
        }
    </style>
@endsection

@section('contents')
    <div style="padding: 25px;">
        <div class="word-preview">
            {!! $word !!}
        </div>
    </div>
@endsection

@section('addScript')
@endsection
