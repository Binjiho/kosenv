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
                    <li ><a href="{{ route('support',['work_code'=>$work_code]) }}"><span>후원신청</span></a></li>
                    <li class="on"><a href="{{ route('support.search',['work_code'=>$work_code]) }}"><span>후원신청 조회 및 수정</span></a></li>
                </ul>
            </div>

            <div class="img-border-box">
                <img src="/target/202501/assets/image/sub/ic_puzzle.png" alt="">
                <div class="text-wrap">
                    <ul class="list-type list-type-bar">
                        <li>후원신청 수정 기간 : {!! $endDate ?? '' !!}
                            <ul class="list-type list-type-mark">
                                <li>후원신청 수정은 수정 기간 내 결제상태 미입금인 상태만 가능하며, 아래 수정 버튼을 클릭하면 수정모드로 이동합니다.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="" method="">
                <fieldset>
                    <legend class="hide">후원신청 상세</legend>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit">접수번호</div>
                                <div class="form-con">{{ $sup->regnum ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">회사명</div>
                                <div class="form-con">{{ $sup->company ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">대표자명</div>
                                <div class="form-con">{{ $sup->ceo ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">사업장 주소</div>
                                <div class="form-con">({{ $sup->company_zipcode ?? '' }}) {{ $sup->company_address ?? '' }} {{ $sup->company_address2 ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">담당자명</div>
                                <div class="form-con">{{ $sup->manager ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">직급</div>
                                <div class="form-con">{{ $sup->position ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">소속 부서</div>
                                <div class="form-con">{{ $sup->department ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">우편물 수령지</div>
                                <div class="form-con">({{ $sup->manager_zipcode ?? '' }}) {{ $sup->manager_address ?? '' }} {{ $sup->manager_address2 ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">전화</div>
                                <div class="form-con">{{ $sup->tel ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">담당자 핸드폰</div>
                                <div class="form-con">{{ $sup->phone ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">FAX</div>
                                <div class="form-con">{{ $sup->fax ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">담당자 E-MAIL</div>
                                <div class="form-con">{{ $sup->email ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">구분</div>
                                <div class="form-con">
                                    {{ $workshopConfig['grade'][$sup->grade]['name'] ?? '' }} -
                                    @if( ($sup->grade ?? '') == 'S' )
                                        후원 기업 지정 금액
                                    @else
                                        {{ number_format($workshopConfig['grade'][$sup->grade]['price']) ?? '' }}원 (VAT없음)
                                    @endif
                                </div>
                            </li>

                            @if( ($sup->grade ?? '') != 'S' )
                            <li>
                                <div class="form-tit">금액</div>
                                <div class="form-con">
                                    <p class="text-red"><sliong>{{ number_format($sup->price) ?? 0 }}원</sliong></p>
                                </div>
                            </li>
                            <li>
                                <div class="form-tit">결제 방법</div>
                                <div class="form-con">{{ $workshopConfig['spay_method'][$sup->spay_method] ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">결제 상태</div>
                                <div class="form-con">
                                    <p class="text-blue">{{ $workshopConfig['spayment_status'][$sup->spayment_status] ?? '' }}</p>
                                </div>
                            </li>
                                @if(($sup->spay_method ?? '') == 'Bank')
                                <li>
                                    <div class="form-tit">입금 회사명</div>
                                    <div class="form-con">{{ $sup->depositor ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">입금 예정일</div>
                                    <div class="form-con">{{ !empty($sup->deposit_date) ? $sup->deposit_date->format('Y.m.d') : '' }}</div>
                                </li>
                                @endif
                            @endif
                            <li>
                                <div class="form-tit">최초 등록일</div>
                                <div class="form-con">{{ $sup->created_at ?? '' }}</div>
                            </li>
                            <li>
                                <div class="form-tit">최종 등록일</div>
                                <div class="form-con">{{ $sup->complete_at ?? '' }}</div>
                            </li>
                        </ul>
                    </div>

                    @if(($sup->spayment_status ?? '') == 'N' && $isSupportDue == true)
                    <div class="btn-wrap text-center">
                        <a href="{{ route('support',['work_code'=>$work_code, 'sid'=>$sup->sid]) }}" class="btn btn-type1 color-type2">수정</a>
                    </div>
                    @endif
                </fieldset>
            </form>

        </div>
    </article>

@endsection

@section('addScript')
    <script>

    </script>
@endsection