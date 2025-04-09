@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap mt-0">
                <h3 class="sub-tit">이메일 무단 수집거부</h3>
            </div>
            <p>
                대한환경공학회는 정보통신망법 제 50조의 2, 제 50조의 7 등에 의거하여, 한국회계학회가 운영, 관리하는 웹페이지상에서, 이메일 주소 수집 프로그램이나 그 밖의 기술적 장치 등을 이용하여 이메일 주소를 무단으로 수집하는 행위를 거부합니다. <br><br><br>
                [게시일 2014년 2월 1일]
            </p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
