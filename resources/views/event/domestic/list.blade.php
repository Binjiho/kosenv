@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.not_page')
        </div>
    </article>
@endsection

@section('addScript')
@endsection
