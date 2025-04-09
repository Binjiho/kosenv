@extends('workshop.'.$work_code.'.'.'layouts.popup-layout')

@section('addStyle')
    <style>
        @media print {
            /* 프린트 시 URL 및 추가 정보 숨기기 */
            @page {
                margin: 10px;
            }

            body {
                margin: 10px; /* 내용에 여백 제공 */
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
    <div class="popup-wrap win-popup-wrap" id="popup-receipt" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox">
                <div class="popup-con">
                    <p class="title font-noSe">영&nbsp;&nbsp;&nbsp;&nbsp;수&nbsp;&nbsp;&nbsp;&nbsp;증</p>
                    <p class="price">일금 {{ priceKo($reg->price) ?? 0 }}원 정 (&#8361 {{ number_format($reg->price) ?? 0 }})</p>
                    <p class="text">
                        상기 금액을 대한환경공학회 {{ $reg->workshop->subject ?? '' }}<br>
                        등록비로 정히 영수합니다.
                    </p>
                    <p class="date">{{ $reg->payment_date->format('Y-m-d') ?? '' }}</p>
{{--                    <p class="date">{{ date('Y-m-d') }}</p>--}}
                    <div class="sign">
                        <p>사답법인 대한환경공학회 회장</p>
                        <img src="/target/202501/assets/image/popup/receipt_sign.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-wrap text-center">
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