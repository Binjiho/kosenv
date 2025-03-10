@extends('layouts.web-layout')

@section('addStyle')

@endsection

@section('contents')

    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="step-list-wrap">
                <ul class="step-list">
                    <li>Step 1. 약관동의</li>
                    <li>Step 2. 정보입력</li>
                    <li class="on">Step 3. 가입완료</li>
                </ul>
            </div>

            <!-- s:가입 완료 -->
            <div class="signup-complete-wrap type1">
                <img src="/assets/image/sub/ic_signup_complete.png" alt="">
                <div class="tit">대한환경공학회 <span class="text-blue">회원가입이 정상적으로 완료</span>되었습니다.</div>
                <span class="highlights">{{ $target_name ?? '' }}님 회원가입을 축하드립니다.</span>
                <p>
                    <strong class="underline">납부한 회비의 영수증은 마이페이지 &gt; 회비납부조회 메뉴에서 확인 가능합니다.</strong> <br>
                    그 외 궁금한 부분이 있으시면 사무국으로 연락을 주시기 바랍니다. 감사합니다.
                </p>
                <ul>
                    <li class="title">회원가입 관련 문의</li>
                    <li>
                        TEL : <a href="tel:02-383-9652" target="_blank">02.383.9652</a>
                    </li>
                    <li>
                        FAX : 02.383.9654
                    </li>
                    <li>
                        E-MAIL : <a href="{{ env('APP_EMAIL') }}" target="_blank">{{ env('APP_EMAIL') }}</a>
                    </li>
                </ul>
                <div class="btn-wrap text-center">
                    <a href="{{ route('login') }}" class="btn btn-type2 color-type6"><img src="/assets/image/sub/ic_btn_login.png" alt="" class="ic-login"> 로그인 바로가기</a>
                </div>
            </div>
            <!-- //e:가입 완료 -->
        </div>
    <article>
@endsection