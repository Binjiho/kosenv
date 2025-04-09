@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="pc-only-wrap m-show">
                <img src="/target/202501/assets/image/sub/img_pc_only.png" alt="">
                <p>YEP 초록접수는 <span>PC</span>에서만 가능합니다.</p>
            </div>

            <div class="m-hide">
                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu">
                        <li ><a href="{{ route('abstract.info',['work_code'=>$work_code]) }}"><span>YEP 초록접수 안내</span></a></li>
                        <li class="on"><a href="{{ route('abstract.check',['work_code'=>$work_code]) }}"><span>YEP 초록접수</span></a></li>
                        <li><a href="{{ route('abstract.search',['work_code'=>$work_code]) }}"><span>YEP 초록접수 조회 및 수정</span></a></li>
                    </ul>
                </div>

                <div class="success-wrap text-center">
                    <img src="/target/202501/assets/image/sub/img_abstract_success.png" alt="">
                    <p class="tit">대한환경공학회 <strong class="text-green">{{ $abs->workshop->subject ?? '' }}</strong><br>
                        초록접수 완료되었습니다.</p>
                    <p class="des">
                        접수하신 내용은 이메일로 발송되며, 초록접수 마감일 전까지 수정 및 철회 가능합니다.
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
                    <a href="{{ route('abstract.search',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type6">초록접수 조회 및 수정 바로가기</a>
                </div>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>

    </script>
@endsection
