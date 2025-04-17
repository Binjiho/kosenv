
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">개인정보</h4>
    </div>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit">접수번호</div>
                <div class="form-con">{{ $reg->regnum ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 대한환경공학회 홈페이지 회원여부</div>
                <div class="form-con">{{ $workshopConfig['user_chk'][$reg->user_chk] ?? '' }}</div>
            </li>
            @if(($reg->user_chk ?? '') == 'Y')
            <li>
                <div class="form-tit"><strong class="required">*</strong> 대한환경공학회 회원인증</div>
                <div class="form-con">{{ $reg->user->id ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit">{{ date('Y') }}년 연회비 납부 여부</div>
                <div class="form-con">
                    @if(($reg->fee_chk ?? '') == 'Y')
                        <p class="text-blue">완납</p>
                    @else
                        <p class="text-red">미납</p>
                    @endif
                </div>
            </li>
            @else
            <li>
                <div class="form-tit"><strong class="required">*</strong> 비회원 등록 비밀번호</div>
                <div class="form-con">{{ $reg->user_password ?? '' }}</div>
            </li>
            @endif
            <li>
                <div class="form-tit"><strong class="required">*</strong> 국적</div>
                <div class="form-con">{{ $reg_country->cn ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 성명</div>
                <div class="form-con">{{ $reg->name_kr ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 직장명 (소속)</div>
                <div class="form-con">{{ $reg->sosok_kr ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 직위</div>
                <div class="form-con">{{ $reg->position ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 이메일</div>
                <div class="form-con">{{ $reg->email ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 휴대폰번호</div>
                <div class="form-con">{{ $reg->phone ?? '' }}</div>
            </li>
        </ul>
    </div>

    <div class="sub-tit-wrap">
        <h4 class="sub-tit">등록 정보</h4>
    </div>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 참가 구분</div>
                <div class="form-con">{{ $workshopConfig['gubun'][$reg->gubun] ?? '' }}</div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 등록 구분</div>
                <div class="form-con">{{ $workshopConfig['category'][$reg->category]['name'] ?? '' }} - {{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}원</div>
            </li>

            <li>
                <div class="form-tit">등록비</div>
                <div class="form-con"><strong class="text-red">{{ number_format($workshopConfig['category'][$reg->category]['price']) ?? '' }}원</strong></div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 결제 방법</div>
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach($feeConfig['payment_method'] as $key => $val)
                            <label class="radio-group"><input type="radio" name="payment_method" id="payment_method_{{ $key }}" value="{{ $key }}" {{ ($reg->payment_method ?? '') == $key ? 'checked' : '' }}>{{ $val }}</label>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>
    </div>