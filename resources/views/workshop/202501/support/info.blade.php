@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li class="on"><a href="{{ route('support.info',['work_code'=>$work_code]) }}"><span>후원신청 안내</span></a></li>
                    <li><a href="{{ route('support',['work_code'=>$work_code]) }}"><span>후원신청</span></a></li>
                    <li><a href="{{ route('support.search',['work_code'=>$work_code]) }}"><span>후원신청 조회 및 수정</span></a></li>
                </ul>
            </div>
            <div class="date-wrap">
                <img src="/target/202501/assets/image/sub/img_date.png" alt="">
                <div class="text-wrap">
                    <p class="tit">후원신청 마감일: {!! $endDate ?? '' !!}
                </div>
            </div>
            <div class="sub-tit-wrap">
                <h4 class="sub-tit">신청 안내 사항</h4>
            </div>
            <ul class="list-type list-type-dot">
                <li>제출 서류 : 후원신청서, 사업자등록증 사본, 기관 로고(.ai 파일)</li>
                <li>제출 절차 :
                    <ul class="list-type list-type-decimal">
                        <li>홈페이지 신청서 작성</li>
                        <li>이메일( <a href="mailto:kosenv@kosenv.or.kr">kosenv@kosenv.or.kr</a> ) 파일 접수</li>
                    </ul>
                </li>
            </ul>
            <div class="sub-tit-wrap">
                <h4 class="sub-tit">후원 혜택</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">후원 혜택</caption>
                    <colgroup>
                        <col style="width: 15%;">
                        <col style="width: 18%;">
                        <col style="width: 30%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">등급</th>
                        <th scope="col">금액 (VAT 없음)</th>
                        <th scope="col">혜택</th>
                        <th scope="col">공통혜택</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="/target/202501/assets/image/sub/ico_diamond.png" alt="" class="ico">Diamond</td>
                            <td>2,000,000원</td>
                            <td>임직원 학술대회 등록비 면제 3 인, <br> 
                                대한환경공학회 학회지 광고게재 3회</td>
                            <td rowspan="3" class="text-left">
                                <ul class="list-type list-type-bar">
                                    <li>프로그램집 (모바일 웹앱) 광고게재 및 후원사 로고 표기</li>
                                    <li>행사 개회식 및 Break time PPT 후원사 명시</li>
                                    <li>포토존 및 현수막 로고 삽입</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="/target/202501/assets/image/sub/ico_gold.png" alt="" class="ico">Gold</td>
                            <td>1,000,000원</td>
                            <td>임직원 학술대회 등록비 면제 2 인, <br>
                                대한환경공학회 학회지 광고게재 2회</td>
                        </tr>
                        <tr>
                            <td><img src="/target/202501/assets/image/sub/ico_silver.png" alt="" class="ico">Silver</td>
                            <td>후원 기업 지정 금액</td>
                            <td>임직원 학술대회 등록비 면제 1 인, <br>
                                대한환경공학회 학회지 광고게재 1회</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="help-text mt-10 text-blue">※ 환경정책에 따라 현수막 및 배너 제작을 최소화 합니다. 환경을 생각하여 협조 부탁드립니다.</p>
            <div class="sub-tit-wrap">
                <h4 class="sub-tit">결제방법</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li><strong>계좌입금 또는 카드결제</strong></li>
                <li>계좌 입금의 경우 하기 계좌로 입금 요청 드리며. 입금 완료 후 계산서 발급 문의는 사무국((02)383-9652)으로 연락바랍니다</li>
                <li>계좌 번호 : 우리은행 1005-201-691718</li>
                <li>예금주 : (사)대한환경공학회 (*회사명 입금 권장)</li>
            </ul>

            @if($isSupportDue == true)
            <div class="btn-wrap text-center">
                <a href="{{ route('support',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type1">
                    <img src="/target/202501/assets/image/sub/ic_pen.png" alt="" class="left">후원신청 바로가기
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
