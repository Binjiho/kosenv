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
                    <li ><a href="{{ route('registration',['work_code'=>$work_code]) }}"><span>온라인 사전등록</span></a></li>
                    <li class="on"><a href="{{ route('registration.search',['work_code'=>$work_code]) }}"><span>사전등록 조회 및 영수증 출력</span></a></li>
                </ul>
            </div>
            <div class="img-border-box bg-pink">
                <img src="/target/202501/assets/image/sub/ic_refund.png" alt="">
                <div class="text-wrap">
                    <ul class="list-type list-type-dot">
                        <li>환불 신청 기간 : {!! $endDate ?? '' !!} </li>
                        <li>사전등록 환불은 결제완료 상태에서만 신청 가능합니다.</li>
                        <li>환불 신청이 접수되면 사전 등록이 자동으로 취소되며, 해당 환불 신청 취소 및 사전등록 데이터 복구는 불가능합니다. 환불 처리는 최대 7일이 소요될 수 있으며,
                            신용카드 결제 취소의 경우 카드사별 정책에 따라 추가적인 시간이 필요할 수 있습니다.</li>
                        <li>환불 신청 완료 후 재등록을 원하시는 경우, 신규 사전 등록 절차를 다시 진행해 주시기 바랍니다.</li>
                        <li>환불신청 처리결과는 사전등록 조회 페이지에서 확인 가능합니다. (별도 메일 안내는 없습니다.)</li>
                    </ul>
                </div>
            </div>
            <form id="register-frm" method="post" action="{{ route('registration.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-refund">
                <fieldset>
                    <legend class="hide">사전등록 환불</legend>

                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit">접수번호</div>
                                <div class="form-con">{{ $reg->regnum ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">성명</div>
                                <div class="form-con">{{ $reg->name_kr ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">직장명 (소속)</div>
                                <div class="form-con">{{ $reg->sosok_kr ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">이메일</div>
                                <div class="form-con">{{ $reg->email ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">등록비</div>
                                <div class="form-con">{{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">결제 방법</div>
                                <div class="form-con">{{ $workshopConfig['payment_method'][$reg->payment_method] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">최종등록일</div>
                                <div class="form-con">{{ $reg->created_at ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 환불 사유 </div>
                                <div class="form-con">
                                    <input type="text" name="refund_reason" id="refund_reason" class="form-item">
                                </div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 환불 방법 </div>
                                <div class="form-con">
                                    <div class="radio-wrap cst">
                                        @foreach($workshopConfig['refund_method'] as $key => $val)
                                        <label class="radio-group"><input type="radio" name="refund_method" id="refund_method_{{ $key }}" value="{{ $key }}" {{ ($reg->payment_method ?? '') == 'DirectBank' && $key == 'C' ? 'disabled' : ''}}>{{ $val }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="refund_D" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 환불 계좌 은행 명 </div>
                                <div class="form-con">
                                    <input type="text" name="refund_bank" id="refund_bank"  class="form-item">
                                </div>
                            </li>
                            <li class="refund_D" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 환불 계좌번호 </div>
                                <div class="form-con">
                                    <input type="text" name="refund_num" id="refund_num"  class="form-item">
                                </div>
                            </li>
                            <li class="refund_D" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 예금주</div>
                                <div class="form-con">
                                    <input type="text" name="account_name" id="account_name"  class="form-item">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="checkbox-wrap term-check n-bd text-center cst">
                        <label class="checkbox-group"><input type="checkbox" name="refund_yn" id="refund_yn" value="Y">환불신청에 동의합니다.</label>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:$(form).submit();" class="btn btn-type1 color-type2">환불 신청</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">닫기</a>
                    </div>
                </fieldset>
            </form>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

        //회원 인증
        $(document).on('click', "input[name='refund_method']", function() {
            const _method = $(this).val();

            if(_method == 'D') {
                $(".refund_D").show();
            }else{
                $(".refund_D").hide();
            }
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                refund_reason:{
                    isEmpty: true,
                },
                refund_method:{
                    checkEmpty: true,
                },
                refund_bank: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='refund_method']:checked").val() === 'D';
                        }
                    },
                },
                refund_num: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='refund_method']:checked").val() === 'D';
                        }
                    },
                },
                account_name: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='refund_method']:checked").val() === 'D';
                        }
                    },
                },
                refund_yn: {
                    checkEmpty: true,
                },
            },
            messages: {
                refund_reason: {
                    isEmpty: '환불 사유를 입력해주세요.',
                },
                refund_method: {
                    checkEmpty: '환불 방법을 체크해주세요.',
                },
                refund_bank: {
                    isEmpty: '환불 계좌 은행명을 입력해주세요.',
                },
                refund_num: {
                    isEmpty: '환불 계좌번호를 입력해주세요.',
                },
                account_name: {
                    isEmpty: '예금주를 입력해주세요.',
                },
                refund_yn: {
                    checkEmpty: '환불신청 동의를 체크해주세요.',
                },
            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection