@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li class="on"><a href="{{ route('registration.info',['work_code'=>$work_code]) }}"><span>사전등록 안내</span></a></li>
                    <li><a href="{{ route('registration',['work_code'=>$work_code]) }}"><span>온라인 사전등록</span></a></li>
                    <li><a href="{{ route('registration.search',['work_code'=>$work_code]) }}"><span>사전등록 조회 및 영수증 출력</span></a></li>
                </ul>
            </div>
            <div class="date-wrap">
                <img src="/target/202501/assets/image/sub/img_date.png" alt="">
                <div class="text-wrap">
                    <p class="tit">사전등록 마감일: {!! $endDate ?? '' !!}</p>
                </div>
            </div>
            <ul class="regi-step-list">
                <li class="step step1">
                    <img src="/target/202501/assets/image/sub/img_regi_step01.png" alt="">
                    <p>사전등록 및 결제 완료</p>
                </li>
                <li class="arrow">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow.png" alt="" class="m-hide">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow_m.png" alt="" class="m-show">
                </li>
                <li class="step step2">
                    <img src="/target/202501/assets/image/sub/img_regi_step02.png" alt="">
                    <p>행사 당일 사전등록대에서 사전등록정보 QR코드스캔</p>
                </li>
                <li class="arrow">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow.png" alt="" class="m-hide">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow_m.png" alt="" class="m-show">
                </li>
                <li class="step step3">
                    <img src="/target/202501/assets/image/sub/img_regi_step03.png" alt="">
                    <p>본인QR코드 스캔</p>
                </li>
                <li class="arrow">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow.png" alt="" class="m-hide">
                    <img src="/target/202501/assets/image/sub/img_regi_arrow_m.png" alt="" class="m-show">
                </li>
                <li class="step step4">
                    <img src="/target/202501/assets/image/sub/img_regi_step04.png" alt="">
                    <p>명찰 (프로그램북, 식권 등) 수령</p>
                </li>
            </ul>
            @if($isRegistDue == true)
            <div class="btn-wrap text-center">
                <a href="{{ route('registration',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type1">
                    <img src="/target/202501/assets/image/sub/ic_pen.png" alt="" class="left">사전등록 바로가기
                </a>
            </div>
            @endif
            <div class="sub-tit-wrap">
                <h4 class="sub-tit">등록비</h4>
            </div>
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">등록비</caption>
                    <colgroup>
                        <col style="width: 30%;">
                        <col style="width: 30%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" colspan="2">구분</th>
                        <th scope="col">금액</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="3">회원</td>
                        <td>일반</td>
                        <td>180,000원</td>
                    </tr>
                    <tr>
                        <td>학생</td>
                        <td>120,000원</td>
                    </tr>
                    <tr>
                        <td>2025년 연회비 미납 회원</td>
                        <td>200,000원</td>
                    </tr>
                    <tr>
                        <td colspan="2">비회원</td>
                        <td>200,000원</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="info-text help-text mt-10 text-red">숙박을 신청하실 회원께서는 참가안내-숙소 메뉴의 객실 예약 신청 페이지에서 개별 신청이 가능합니다.</p>
            <div class="sub-tit-wrap">
                <h4 class="sub-tit">환불규정</h4>
            </div>
            <ul class="list-type list-type-dot">
                <li>환불을 원하시는 경우 사전등록 조회 페이지에서 환불 계좌번호를 포함하여 신청하시기 바랍니다. </li>
                <li>등록비 환불은 1주 정도 소요됩니다.</li>
            </ul>
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">환불규정</caption>
                    <colgroup>
                        <col style="width: 50%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">전 액 환 불 (접수기준)</th>
                        <th scope="col">환 불 불 가</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>6월 2일 (월) 24시 까지</td>
                        <td>6월 2일 (월) 24시 이후</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @if($isRegistDue == true)
            <div class="btn-wrap text-center">
                <a href="{{ route('registration',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type1">
                    <img src="/target/202501/assets/image/sub/ic_pen.png" alt="" class="left">사전등록 바로가기
                </a>
            </div>
            @endif
        </div>
    </article>
@endsection

@section('addScript')
    <script>
    </script>
@endsection
