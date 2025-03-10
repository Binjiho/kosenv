@extends('layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap " id="popup-fee" style="display: block;">
        @if(!empty($registration->resultCode))
            @include('common.inicis.resultMap', ['resultMap' => $registration])
        @endif

        <div class="popup-contents">
            <div class="popup-contit-wrap">
                <h2 class="popup-contit">{{ $target_category ?? '' }} 납부</h2>
                <button type="button" class="btn btn-pop-close wh" onclick="$(this).close();">팝업 닫기</button>
            </div>
            <div class="popup-conbox">
                <div class="popup-con">
                    <form id="regFrm" method="post" data-sid="{{ request()->sid ?? 0 }}" action="{{ route('fee.data') }}" data-case="fee-create" onsubmit="return false;">
{{--                        <input type="hidden" name="sid" value="{{ $fee->sid ?? 0 }}" readonly>--}}
                        <input type="hidden" name="price" value="{{ $target_price ?? 0 }}" readonly>
                        <input type="hidden" name="category" value="{{ $target_category ?? 0 }}" readonly>
                        <fieldset>
                            <ul class="write-wrap">
                                <li>
                                    <div class="form-tit">회원등급</div>
                                    <div class="form-con">{{ $userConfig['gubun'][$user->gubun ?? ''] ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">이름</div>
                                    <div class="form-con">{{ $user->name_kr ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">아이디</div>
                                    <div class="form-con">{{ $user->id ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">직장명</div>
                                    <div class="form-con">{{ $user->company ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">
                                        결제방법
                                    </div>
                                    <div class="form-con">
                                        <div class="radio-wrap cst">
                                            @foreach($feeConfig['payment_method'] as $key => $val)
                                            <label class="radio-group"><input type="radio" name="payment_method" id="payment_method_{{ $key }}" value="{{ $key }}">{{ $val }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <p class="price-con">{{ $target_category ?? '연회비' }} 납부금액 : {{ number_format($target_price) ?? 0 }}원</p>
                            <div class="btn-wrap text-center">
                                <a href="javascript:$(this).close();" class="btn btn-type1 btn-pop-cancel">닫기</a>
                                <button class="btn btn-type1 color-type6">결제</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#regFrm';

        window.addEventListener( 'message', (e) => { // 결제 성공후 호출
            if( e.data.functionName === 'submit' ) {
                $(form).submit();
            }
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                payment_method: {
                    checkEmpty: true,
                },
            },
            messages: {
                payment_method: {
                    checkEmpty: '결제방법을 선택해주세요.',
                },
            },
            submitHandler: function () {
                let payment_status = 'N';
                const fee = $("input[name='price']").val();

                if(fee == 0) {
                    payment_status = 'F';
                }

                payment_status = 'Y';

                @if(CheckUrl() != 'admin')
                // 관리자 페이지 아닐때만
                if($('#resultCode').length == 0) {
                    $('#inicisF').remove() // 결제 호출 폼 삭제

                    callAjax('{{ route('inicis.init') }}', {
                        'price': fee, // 금액
                        'goodname': '{{ $fee->year ?? date('Y') }}{{ $target_category ?? '' }}', // 상품명 (필수)
                        'buyername': '{{ $user->name_kr ?? '박지호' }}', // 구매자 (필수)
                        'buyeremail': '{{ $user->email ?? 'jh2.park@m2community.co.kr' }}', // 이메일 (필수)
                        'buyertel': '{{ $user->phone ?? '010-2239-1948' }}', // 연락처 (필수)
                        'payment_method': $("input[name='payment_method']:checked").val(), // 결제 방법
                    });
                    return false;
                }
                @endif

                let ajaxData = newFormData(form);

                ajaxData.append('payment_status', payment_status);

                callMultiAjax($(form).attr('action'), ajaxData);
            }
        });

    </script>

@endsection