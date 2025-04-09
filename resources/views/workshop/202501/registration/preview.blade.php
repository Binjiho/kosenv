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
            <form id="regFrm" method="post" action="{{ route('registration.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-complete">
                <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
                <input type="hidden" name="price" id="price" value="{{ $reg->price ?? 0 }}" readonly>

                <fieldset>
                    <legend class="hide">사전등록 미리보기</legend>

                    <div class="write-tit-wrap">
                        <img src="/target/202501/assets/image/sub/ic_write.png" alt="">
                        <div class="text-wrap">
                            <p class="tit">{{ $workshop->subject ?? '' }} 사전등록 신청서</p>
                            <p class="des">사전등록 마감일 : {!! $endDate ?? '' !!}</p>
                        </div>
                    </div>
                    <div class="bg-box bg-orange text-center">
                        입력하신 내용을 확인하신 후, 수정할 사항이 없다면 아래의 등록 <strong class="text-orange">최종 완료</strong> 버튼을 클릭해 주세요.<br>
                        또한, 등록 완료 메일을 받아야 최종 등록이 완료 됩니다.
                    </div>

                    @include('workshop.'.$work_code.'.'.'registration.form.preview-frm')

                </fieldset>

                <div class="btn-wrap text-center">
                    <a href="javascript:$(form).submit();" class="btn btn-type1 color-type3">최종 완료</a>
                    <a href="{{ route('registration',['work_code'=>$work_code,'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type2">수정</a>
                    <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
                </div>
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
                        'goodname': '{{ $work_code ?? '' }} 사전등록', // 상품명 (필수)
                        'buyername': '{{ $reg->name_kr ?? '박지호' }}', // 구매자 (필수)
                        'buyeremail': '{{ $reg->email ?? 'jh2.park@m2community.co.kr' }}', // 이메일 (필수)
                        'buyertel': '{{ $reg->phone ?? '010-2239-1948' }}', // 연락처 (필수)
                        'payment_method': $("input[name='payment_method']:checked").val(), // 결제 방법
                        'status': payment_status, // 결제 방법
                    });
                    return false;
                }
                @endif

                let ajaxData = newFormData(form);

                ajaxData.append('status', payment_status);

                callMultiAjax($(form).attr('action'), ajaxData);
            }
        });

    </script>
@endsection