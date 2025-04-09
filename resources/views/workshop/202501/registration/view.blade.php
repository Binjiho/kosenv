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
            <div class="img-border-box">
                <img src="/target/202501/assets/image/sub/ic_view.png" alt="">
                <div class="text-wrap">
                    <ul class="list-type list-type-bar">
                        <li>사전등록 수정 기간 : {!! $endDate ?? '' !!} </li>
                    </ul>
                    <ul class="list-type list-type-mark">
                        <li>사전등록 수정은 수정 기간 내 결제상태 미입금인 상태만 가능하며, 아래 수정 버튼을 클릭하면 수정모드로 이동합니다.</li>
                        <li>영수증 인쇄는 결제상태 > 입금 완료 상태인 경우에만 영수증, 거래명세서 인쇄 버튼 노출됩니다.</li>
                        <li>사전등록비 환불의 경우 결제상태 > 입금 완료 상태인 경우에만 환불신청 버튼 노출 됩니다. 해당 버튼 클릭 후 환불 신청 가능합니다.</li>
                    </ul>
                </div>
            </div>
            <div class="btn-wrap text-right">
                @if(($reg->status ?? '') == 'Y')
                <div class="left">
                    <a href="{{ route('abstract.check',['work_code'=>$work_code]) }}" class="btn btn-type1 color-type3">초록접수 바로가기</a>
                </div>
                @endif

                @if(($reg->payment_status ?? '') == 'Y')
                    <a href="{{ route('registration.receipt',['work_code'=>$work_code, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type2 call-popup" data-popup_name="receipt-pop" data-width="800" data-height="900">영수증 출력</a>
                    <a href="{{ route('registration.transaction',['work_code'=>$work_code, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type6 call-popup" data-popup_name="transaction-pop" data-width="900" data-height="700">거래명세서 출력</a>
                @endif
                @if( ($reg->payment_status ?? '') == 'Y' && $isRegistDue == true )
                    <a href="{{ route('registration.refund',['work_code'=>$work_code, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type5">환불 신청</a>
                @endif
            </div>

            <form action="" method="">
                <fieldset>
                    <legend class="hide">사전등록 상세</legend>
                    <div class="write-wrap mt-10">
                        <ul>
                            <li>
                                <div class="form-tit">접수번호</div>
                                <div class="form-con">{{ $reg->regnum ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">대한환경공학회 홈페이지 회원여부</div>
                                <div class="form-con">{{ $workshopConfig['user_chk'][$reg->user_chk] ?? '' }}</div>
                            </li>
                            @if(($reg->user_chk ?? '') == 'Y')
                            <li>
                                <div class="form-tit">대한환경공학회 회원인증</div>
                                <div class="form-con">ID : {{ $reg->user->id ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">{{ date('Y') }}년 연회비 납부 여부</div>
                                @if(($reg->fee_chk ?? '') == 'Y')
                                <div class="form-con">완납</div>
                                @else
                                <div class="form-con">미납</div>
                                @endif
                            </li>
                            @else
                            <li>
                                <div class="form-tit">비회원 등록 비밀번호</div>
                                <div class="form-con">{{ $reg->user_password ?? '' }}</div>
                            </li>
                            @endif
                            <li>
                                <div class="form-tit">국적</div>
                                <div class="form-con">{{ $reg_country->cn ?? '' }}</div>
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
                                <div class="form-tit">직위</div>
                                <div class="form-con">{{ $reg->position ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">이메일</div>
                                <div class="form-con">{{ $reg->email ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">휴대폰번호</div>
                                <div class="form-con">{{ $reg->phone ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">참가 구분</div>
                                <div class="form-con">{{ $workshopConfig['gubun'][$reg->gubun] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">등록 구분</div>
                                <div class="form-con">{{ $workshopConfig['category'][$reg->category]['name'] ?? '' }} - {{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}원</div>
                            </li>
                            <li>
                                <div class="form-tit">셔틀버스 수요조사</div>
                                <div class="form-con">{{ $workshopConfig['shuttle_yn'][$reg->shuttle_yn] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">등록비</div>
                                <div class="form-con">
                                    <p class="text-red">{{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">결제 방법</div>
                                <div class="form-con">{{ $workshopConfig['payment_method'][$reg->payment_method] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">결제 상태</div>
                                <div class="form-con">
                                    <p class="text-blue">{{ $workshopConfig['payment_status'][$reg->payment_status] ?? '' }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">최초 등록일</div>
                                <div class="form-con">{{ $reg->created_at ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">최종 등록일</div>
                                <div class="form-con">{{ $reg->complete_at ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">환불 신청일</div>
                                <div class="form-con">{{ $reg->refund_at ?? '' }}</div>
                            </li>
                        </ul>
                    </div>

                    @if(($reg->payment_status ?? '') == 'N' && $isRegistDue == true)
                        <div class="btn-wrap text-center">
                            <a href="{{ route('registration',['work_code'=>$work_code, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type2">수정</a>
                        </div>
                    @endif

                    {{-- 예외등록 기간 체크 --}}
                    @if($reg->isGraceTarget() && $reg->workshop->isRegistGraceDue() )
                        <div class="btn-wrap text-center">
                            <a href="{{ route('registration',['work_code'=>$work_code, 'sid'=>$reg->sid]) }}" class="btn btn-type1 color-type2">유예등록</a>
                        </div>
                    @endif
                </fieldset>
            </form>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

        $(document).on('keyup', 'input[name=email]', function() {
            $(this).data('chk', 'N');
        });

        const boardSubmit = () => {
            // if($("#agree1").is(":checked") == false){
            //     alert('개인정보 수집 및 이용 동의에 동의해주세요.');
            //     return false;
            // }
            // if($("#agree2").is(":checked") == false){
            //     alert('개인정보 제3자 제공에 동의해주세요.');
            //     return false;
            // }

            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('reg-script')
@endsection