@extends('layouts.popup-layout')

@section('addStyle')
    <style>
        @media print {
            /* 프린트 시 URL 및 추가 정보 숨기기 */
            @page {
                margin: 0;
            }

            body {
                margin: 1cm; /* 내용에 여백 제공 */
            }

            /* 모든 링크의 URL 숨기기 */
            a[href]:after {
                content: none !important;
            }

            /* 헤더, 푸터 숨기기 */
            header, footer {
                display: none !important;
            }

            /* 불필요한 요소 숨기기 */
            .no-print,
            .hidden-print {
                display: none !important;
            }
        }
    </style>
    <link type="text/css" rel="stylesheet" href="/target/202501/assets/css/slick.css">
    <link type="text/css" rel="stylesheet" href="/target/202501/assets/css/common.css">
@endsection

@section('contents')
    <div class="popup-wrap win-popup-wrap" id="popup-invoice" style="display: block;">
        <div class="popup-contents" id="print_content">
            <div class="popup-conbox">
                <div class="popup-con">
                    <p class="title">거래명세서</p>
                    <div class="table-wrap">
                        <table class="cst-table">
                            <caption class="hide">거래명세서</caption>
                            <colgroup>
                                <col style="width: 12%;">
                                <col style="width: 20%;">
                                <col style="width: 9%;">
                                <col style="width: 12%;">
                                <col style="width: 21%;">

                                <col style="width: 8%;">
                                <col>
                            </colgroup>
                            <tbody>
                            <tr>
                                <th rowspan="2">거래일자</th>
                                <td rowspan="2">{{ $reg->payment_date? $reg->payment_date->format('Y-m-d') : '' }}</td>
                                <td rowspan="5">공급자</td>
                                <th>고유번호</th>
                                <td colspan="3">229-82-01440</td>
                            </tr>
                            <tr>
                                <th>상호</th>
                                <td>(사)대한환경공학회</td>
                                <th>성명</th>
                                <td class="sign">
                                    <div>강석태 <img src="/assets/image/popup/img_sign.png" alt=""></div>
                                </td>
                            </tr>
                            <tr>
                                <th>담당자</th>
                                <td>{{ $reg->name_kr ?? '' }} 귀하</td>
                                <th>사업장 주소</th>
                                <td colspan="3">서울시 중구 청파로 464, 브라운스톤서울 101동 726호</td>
                            </tr>
                            <tr>
                                <td colspan="2" rowspan="2">아래와 같이 거래합니다</td>
                                <th>업태</th>
                                <td colspan="3">서비스</td>
                            </tr>
                            <tr>
                                <th>종목</th>
                                <td colspan="3">광고,기술개발 및 기술지도</td>
                            </tr>
                            <tr>
                                <td colspan="7">거래내역</td>
                            </tr>
                            <tr>
                                <th colspan="3">등록</th>
                                <th colspan="2">단가(원)</th>
                                <th colspan="2">공급가액</th>
                            </tr>
                            <tr>
                                <td colspan="3">{{ $reg->workshop->subject ?? '' }} 등록비</td>
                                <td colspan="2">{{ number_format($reg->price) ?? 0 }}</td>
                                <td colspan="2">{{ number_format($reg->price) ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>합계</strong></td>
                                <td colspan="4" class="text-right">{{ number_format($reg->price) ?? 0 }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-wrap text-center no-print">
            <a href="javascript:self.close();" class="btn btn-type1 btn-pop-cancel">닫기</a>
            <button class="btn btn-type1 color-type6" onclick="goPrint();">프린트</button>
        </div>
    </div>
@endsection

@section('addScript')
<script>
    function goPrint() {
        window.print();
    }
</script>
@endsection