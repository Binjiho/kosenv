@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li><a href="{{ route('registration.info',['work_code'=>$work_code]) }}"><span>사전등록 안내</span></a></li>
                    <li class="on"><a href="{{ route('registration',['work_code'=>$work_code]) }}"><span>온라인 사전등록</span></a></li>
                    <li><a href="{{ route('registration.search',['work_code'=>$work_code]) }}"><span>사전등록 조회 및 영수증 출력</span></a></li>
                </ul>
            </div>
            <div class="success-wrap text-center">
                <img src="/target/202501/assets/image/sub/img_success.png" alt="">
                <p class="tit">대한환경공학회 <strong class="text-blue">{{ $workshop->subject ?? '' }}</strong><br>
                    사전등록 완료되었습니다.</p>
                <p class="des">
                    접수하신 내용은 이메일로 발송되며, 영수증은 사전등록 조회 후 출력 가능합니다. <br>
                    문의사항은 준비사무국으로 연락 주시기 바랍니다.
                </p>
                <ul>
                    <li>
                        <img src="/target/202501/assets/image/sub/ic_tel.png" alt="">
                        <strong>TEL : </strong><a href="tel:+82-{{ env('APP_DASHTEL') }}">{{ env('APP_DASHTEL') }}</a>
                    </li>
                    <li>
                        <img src="/target/202501/assets/image/sub/ic_mail.png" alt="">
                        <strong>E-MAIL : </strong><a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a>
                    </li>
                </ul>
            </div>
            <div class="btn-wrap text-center">
                <a href="{{ route('registration.search',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type3">사전등록 조회 및 영수증 출력 바로가기</a>
            </div>

        </div>
    </article>

@endsection

@section('addScript')

@endsection