@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li ><a href="{{ route('support.info',['work_code'=>$work_code]) }}"><span>후원신청 안내</span></a></li>
                    <li class="on"><a href="{{ route('support',['work_code'=>$work_code]) }}"><span>후원신청</span></a></li>
                    <li><a href="{{ route('support.search',['work_code'=>$work_code]) }}"><span>후원신청 조회 및 수정</span></a></li>
                </ul>
            </div>

            <div class="success-wrap text-center">
                <img src="/target/202501/assets/image/sub/img_donation_success.png" alt="">
                <p class="tit">대한환경공학회 <strong class="text-mint">{{ $workshop->subject ?? '' }}</strong><br>
                    후원신청 완료되었습니다.</p>
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
                <a href="{{ route('support.search',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type11">후원신청 조회 및 수정 바로가기</a>
            </div>

        </div>
    </article>

@endsection

@section('addScript')

@endsection