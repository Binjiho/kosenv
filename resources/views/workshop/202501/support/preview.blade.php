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
            <form id="regFrm" method="post" action="{{ route('support.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($sup->sid) ? $sup->sid : '' }}" data-case="support-complete">
                <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
                <input type="hidden" name="price" id="price" value="{{ $sup->price ?? 0 }}" readonly>
                <fieldset>
                    <legend class="hide">후원신청 미리보기</legend>
                    <div class="write-tit-wrap bg-mint">
                        <img src="/target/202501/assets/image/sub/ic_write.png" alt="">
                        <div class="text-wrap">
                            <p class="tit">{{ $workshop->subject ?? '' }} 후원 신청서</p>
                            <p class="des">후원신청 마감일 : {!! $endDate ?? '' !!}</p>
                        </div>
                    </div>

                    <div class="bg-box bg-orange text-center">
                        입력하신 내용을 확인하신 후, 수정할 사항이 없다면 아래의 등록 <strong class="text-orange">최종 완료</strong> 버튼을 클릭해 주세요.<br>
                        또한, 등록 완료 메일을 받아야 최종 등록이 완료 됩니다.
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-tit">회사 기본 정보</h4>
                    </div>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 접수번호</div>
                                <div class="form-con">{{ $sup->regnum ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 회사명</div>
                                <div class="form-con">{{ $sup->company ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 대표자명</div>
                                <div class="form-con">{{ $sup->ceo ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 사업장 주소</div>
                                <div class="form-con">({{ $sup->company_zipcode ?? '' }}) {{ $sup->company_address ?? '' }} {{ $sup->company_address2 ?? '' }}</div>
                            </li>
                        </ul>
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-tit">담당자 정보</h4>
                    </div>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 담당자명</div>
                                <div class="form-con">{{ $sup->manager ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 직급</div>
                                <div class="form-con">{{ $sup->position ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 소속 부서</div>
                                <div class="form-con">{{ $sup->department ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 우편물 수령지</div>
                                <div class="form-con">({{ $sup->manager_zipcode ?? '' }}) {{ $sup->manager_address ?? '' }} {{ $sup->manager_address2 ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 전화</div>
                                <div class="form-con">{{ $sup->tel ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 담당자 핸드폰</div>
                                <div class="form-con">{{ $sup->phone ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">FAX</div>
                                <div class="form-con">{{ $sup->fax ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 담당자 E-MAIL</div>
                                <div class="form-con">{{ $sup->email ?? '' }}</div>
                            </li>
                        </ul>
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-tit">후원 구분</h4>
                    </div>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 구분</div>
                                <div class="form-con">
                                    <p class="text-red">
                                        {{ $workshopConfig['grade'][$sup->grade]['name'] ?? '' }} -
                                        @if( ($sup->grade ?? '') == 'S')
                                            후원 기업 지정 금액
                                        @else
                                            {{ number_format($workshopConfig['grade'][$sup->grade]['price']) ?? '' }}원 (VAT없음)
                                        @endif
                                    </p>
                                </div>
                            </li>

                            @if( ($sup->grade ?? '') != 'S' )
                            <li>
                                <div class="form-tit">금액</div>
                                <div class="form-con">
                                    <p class="text-red"><strong>{{ number_format($sup->price) ?? 0 }}원</strong></p>
                                </div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 결제 방법</div>
                                <div class="form-con">
                                    <div class="radio-wrap cst">
                                        @foreach($workshopConfig['spay_method'] as $key => $val)
                                        <label class="radio-group"><input type="radio" name="spay_method" value="{{ $key }}">{{ $val }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="bank_li" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 입금 회사명</div>
                                <div class="form-con">
                                    <input type="text" class="form-item" name="depositor" id="depositor">
                                    <p class="text-red help-text mt-10">* 신청 회사명과 동일하게 입금 요청 드립니다</p>
                                </div>
                            </li>
                            <li class="bank_li" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 입금 예정일</div>
                                <div class="form-con">
                                    <input type="text" class="form-item" name="deposit_date" id="deposit_date" datepicker readonly>
                                </div>
                            </li>
                            <li class="bank_li" style="display: none;">
                                <div class="form-tit"><strong class="required">*</strong> 입금 계좌 정보</div>
                                <div class="form-con">우리은행 1005-201-691718 / 예금주 : 대한환경공학회</div>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:$(form).submit();" class="btn btn-type1 color-type3">최종 완료</a>
                        <a href="{{ route('support',['work_code'=>$work_code,'sid'=>$sup->sid]) }}" class="btn btn-type1 color-type2">수정</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#regFrm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

        window.addEventListener( 'message', (e) => { // 결제 성공후 호출
            if( e.data.functionName === 'submit' ) {
                $(form).submit();
            }
        });

        $(document).on('click', 'input[name=spay_method]', function() {
            const _val = $(this).val();
            console.log(_val);
            if(_val == 'Bank'){
                $(".bank_li").show();
            }else{
                $(".bank_li").hide();
            }
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                spay_method: {
                    checkEmpty: true,
                },
                depositor: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='spay_method']:checked").val() === 'Bank';
                        }
                    }
                },
                deposit_date: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='spay_method']:checked").val() === 'Bank';
                        }
                    }
                },
            },
            messages: {
                spay_method: {
                    checkEmpty: '결제방법을 선택해주세요.',
                },
                depositor: {
                    isEmpty: '입금 회사명을 입력해주세요.',
                },
                deposit_date: {
                    isEmpty: '입금 예정일을 입력해주세요.',
                },
            },
            submitHandler: function () {
                const _spay_method = $("input[name='spay_method']:checked").val();
                const _fee = $("input[name='price']").val();

                if(_fee == 0) {
                    payment_status = 'F';
                }

                if(_spay_method == 'Card') {
                    payment_status = 'Y';
                }else{
                    payment_status = 'N';
                }

                @if(CheckUrl() != 'admin')
                // 관리자 페이지 아닐때만
                if($('#resultCode').length == 0) {
                    $('#inicisF').remove() // 결제 호출 폼 삭제

                    if(_spay_method == 'Card'){
                        callAjax('{{ route('inicis.init') }}', {
                            'price': _fee, // 금액
                            'goodname': '{{ $work_code ?? '' }} 후원신청', // 상품명 (필수)
                            'buyername': '{{ $sup->manager ?? '박지호' }}', // 구매자 (필수)
                            'buyeremail': '{{ $sup->email ?? 'jh2.park@m2community.co.kr' }}', // 이메일 (필수)
                            'buyertel': '{{ $sup->phone ?? '010-2239-1948' }}', // 연락처 (필수)
                            'payment_method': _spay_method, // 결제 방법
                            'status': payment_status, // 결제 방법
                        });
                        return false;
                    }
                }
                @endif

                let ajaxData = newFormData(form);

                ajaxData.append('spayment_status', payment_status);

                callMultiAjax($(form).attr('action'), ajaxData);
            }
        });

    </script>
@endsection