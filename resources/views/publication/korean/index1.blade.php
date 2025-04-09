@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox">
                <div class="sub-tab-wrap type3">
                    <ul class="sub-tab-menu">
                        <li class="on"><a href="{{ route('publication.korean',['tab'=>1]) }}">소개</a></li>
                        <li><a href="{{ route('publication.korean',['tab'=>2]) }}">편집위원장 인사말</a></li>
                        <li><a href="{{ route('publication.korean',['tab'=>3]) }}">편집위원회</a></li>
                        <li><a href="https://submit.kosenv.or.kr/" target="_blank">투고하기</a></li>
                    </ul>
                </div>
                <div class="bg-box">
                    <strong class="tit">대한환경공학회지</strong>
                    <p>
                        Journal of Korean Society of Environmental Engineers <br>
                        J. Korean Soc. Environ. Eng. <br><br>
                        JKSEE : J-K-See (제이-케이-씨)
                    </p>
                </div>
                <ul class="journal-info">
                    <li>
                        <span class="tit">창간년</span>
                        <p>1979년</p>
                    </li>
                    <li>
                        <span class="tit">plSSN</span>
                        <p>1225-5025</p>
                    </li>
                    <li>
                        <span class="tit">elSSN</span>
                        <p>2382-7810</p>
                    </li>
                    <li>
                        <span class="tit">발행간기</span>
                        <p>연 12회</p>
                    </li>
                </ul>
                <div class="journal-banner">
                    <p>
                        대한환경공학지에 <br>
                        논문을 투고해주셔서 감사합니다.
                    </p>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
