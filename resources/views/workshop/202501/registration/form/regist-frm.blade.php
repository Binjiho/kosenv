<div class="sub-tit-wrap">
        <h4 class="sub-tit">개인정보</h4>
    </div>
    <p class="help-text mb-10">※ 필수 입력 항목은 빨간색 (<span class="required">*</span>)이 표시되어 있습니다.</p>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 대한환경공학회 홈페이지 회원여부</div>
                @if(checkUrl() !== 'admin' && empty($reg->sid))
                    <div class="form-con">
                        <div class="radio-wrap cst">
                            @foreach( $workshopConfig['user_chk'] as $key => $val )
                                <label class="radio-group" for="user_chk_{{ $key }}">
                                    <input type="radio" name="user_chk" id="user_chk_{{ $key }}" class="user_chk" value="{{ $key }}" {{ ( $reg->user_chk ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="form-con">
                        {{ $workshopConfig['user_chk'][$reg->user_chk] ?? '' }}
                    </div>
                @endif
            </li>

            @if(checkUrl() !== 'admin' && empty($reg->sid))
            <li class="user_chk_Y" style="{{ ($reg->user_chk ?? '') == 'Y' ? '' : 'display:none' }}">
                <div class="form-tit"><strong class="required">*</strong> 대한환경공학회 회원인증</div>
                <div class="form-con">
                    <p class="mb-10 help-text text-blue">* 대한환경공학회 홈페이지 아이디 / 비밀번호 입력해주세요.</p>
                    <div class="form-group-text has-btn">
                        <input type="hidden" class="form-item" name="user_sid" id="user_sid" value="" readonly>
                        <input type="hidden" class="form-item" name="fee_chk" id="fee_chk" value="" readonly>
                        <span class="text">ID :</span>
                        <input type="text" class="form-item" name="user_id" id="user_id" data-chk="{{ !empty($reg->sid) ? 'Y':'N' }}">
                        <span class="text">PW :</span>
                        <input type="password" class="form-item" name="password" id="password">
                        <div class="btn-wrap mt-0">
                            <a href="javascript:;" id="uid_chk" class="btn btn-small color-type3 btn-line" style="{{ ($reg->user_chk ?? '') == 'Y' ? 'display: none;' : '' }}">회원 인증</a>
                            <a href="javascript:;" id="uid_ok" class="btn btn-small color-type7" style="{{ ($reg->user_chk ?? '') == 'Y' ? '' : 'display: none;' }}">회원 인증 완료</a>
                            <a href="javascript:;" id="uid_reset" class="btn btn-small color-type4 btn-line">인증 초기화</a>
                            <a href="{{ route('findId') }}" id="" class="btn btn-small color-type2" target="_blank">학회 회원 ID/PW 찾기</a>
                        </div>

                    </div>
                </div>
            </li>
            @endif

            <li class="user_chk_Y" style="{{ ($reg->user_chk ?? '') == 'Y' ? '' : 'display:none' }}">
                <div class="form-tit">{{ date('Y') }}년 연회비 납부 여부</div>
                <div class="form-con">
                    @if(!empty($reg->fee_chk))
                    <p id="fee_text" class="text-{{ ($reg->fee_chk ?? '') == 'Y' ? 'blue' : 'red' }}" style="{{ ($reg->fee_chk ?? '') == '' ? 'display:none;' : '' }}">{{ ($reg->fee_chk ?? '') == 'Y' ? '완납' : '미납' }}</p>
                    @else
                    <p id="fee_text" class=""></p>
                    @endif

                    @if(checkUrl() !== 'admin' && empty($reg->sid))
                    <p class="help-text mt-10">* 연회비 미납 회원의 경우 비회원 등록비로 납부 됩니다. 회원가로 등록을 원하시는 경우 연회비 납부 후 다시 등록 진행 요청 드립니다.
                        <a href="{{ route('mypage.fee') }}" class="text-blue" target="_blank">[회비 납부 바로가기]</a>
                    </p>
                    @endif
                </div>
            </li>

            @if(checkUrl() !== 'admin' && empty($reg->sid))
            <li class="user_chk_N" style="{{ ($reg->user_chk ?? '') == 'N' ? '' : 'display:none' }}">
                <div class="form-tit"><strong class="required">*</strong> 비회원 등록 비밀번호</div>
                <div class="form-con">
                    <input type="password" name="user_password" id="user_password" value="{{ $reg->user_password ?? '' }}" maxlength="8" class="form-item">
                    <p class="help-text text-blue mt-10">* 사전등록 조회 시 사용되는 비밀번호입니다. 영문+숫자 조합으로 5~8자리로 입력 부탁 드립니다.</p>
                </div>
            </li>
            @endif

            <li>
                <div class="form-tit"><strong class="required">*</strong> 국적</div>
                <div class="form-con">
                    <select name="country" id="country" class="form-item">
                        <option value="">국적 선택</option>
                        @foreach($country as $key => $val)
                        <option value="{{ $val->cc ?? '' }}" {{ ($reg->country ?? '') == $val->cc ? 'selected' : '' }}>{{ $val->cn ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 성명</div>
                <div class="form-con">
                    <input type="text" name="name_kr" id="name_kr" value="{{ $reg->name_kr ?? '' }}" class="form-item">
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 직장명 (소속)</div>
                <div class="form-con">
                    <input type="text" name="sosok_kr" id="sosok_kr" value="{{ $reg->sosok_kr ?? '' }}" class="form-item">
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 직위</div>
                <div class="form-con">
                    <input type="text" name="position" id="position" value="{{ $reg->position ?? '' }}" class="form-item">
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 이메일</div>
                <div class="form-con">
                    <div class="form-group has-btn">
                        <input type="text" class="form-item emailOnly" name="email" id="email" value="{{ $reg->email ?? '' }}" data-chk="N">
                        <a href="javascript:;" id="email_chk" class="btn btn-small color-type7">중복확인</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 휴대폰번호</div>
                <div class="form-con">
                    <?php
                    if( !empty($reg->phone) ){
                        $phone = explode('-', $reg->phone);
                    }
                    ?>
                    <div class="form-group-text has-btn">
                        <input type="text" class="form-item" name="phone[]" id="phone1" value="{{ $phone[0] ?? '' }}" onlyNumber data-chk="N">
                        <span class="text">-</span>
                        <input type="text" class="form-item" name="phone[]" id="phone2" value="{{ $phone[1] ?? '' }}" onlyNumber data-chk="N">
                        <span class="text">-</span>
                        <input type="text" class="form-item" name="phone[]" id="phone3" value="{{ $phone[1] ?? '' }}" onlyNumber data-chk="N">
                        <a href="javascript:;" id="phone_chk" class="btn btn-small color-type7">중복확인</a>
                    </div>
                </div>
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
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach( $workshopConfig['gubun'] as $key => $val )
                            <label class="radio-group" for="gubun_{{ $key }}">
                                <input type="radio" name="gubun" id="gubun_{{ $key }}" value="{{ $key }}" data-name="{{ $val }}" {{ ( $reg->gubun ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 등록 구분</div>
                <div class="form-con">
                    <div class="radio-wrap cst">
                        @foreach( $workshopConfig['category'] as $key => $val )
                            @php
                                $disable_chk = '';
                                if(!empty($reg->sid)){
                                    if ($reg->user_chk === 'Y' && in_array($key, ['D', 'E'])) {
                                        $disable_chk = 'disabled';
                                    }
                                    if ($reg->user_chk === 'Y' && $reg->fee_chk == 'N' && in_array($key, ['A', 'B'])) {
                                        $disable_chk = 'disabled';
                                    }
                                    if ($reg->user_chk === 'N' && in_array($key, ['A', 'B', 'C'])) {
                                        $disable_chk = 'disabled';
                                    }

                                    if($reg->gubun !== 'G' && in_array($key, ['F','G'])){
                                        $disable_chk = 'disabled';
                                    }
                                }else{
                                    if(in_array($key, ['F','G'])){
                                        $disable_chk = 'disabled';
                                    }
                                }
                            @endphp
                            <label class="radio-group" for="category_{{ $key }}">
                                <input type="radio" name="category" id="category_{{ $key }}" class="category" value="{{ $key }}" data-name="{{ $val['name'] }}" data-price="{{ number_format($val['price']) }}" {{ ( $reg->category ?? '' ) == $key ? 'checked' : ''  }} {{ $disable_chk }}>{{ $val['name'] }} - {{ number_format($val['price']) }}원
                            </label>
                        @endforeach
                    </div>
                </div>
            </li>

        </ul>
    </div>
    <p class="help-text mt-10 text-red">※ 학생은 석박사통합이 아닌 석사생만 해당됩니다. 잘못 등록하신 경우 재등록 및 결제가 되실 수 있는 점 안내 드립니다.</p>

    <div class="price-box">
        <p class="tit"><span>등록비 : <b id="price_text">{{ !empty($reg->price) ? number_format($reg->price) : 0 }}</b>원</span></p>
        <input type="hidden" name="price" id="price" value="{{ !empty($reg->price) ? number_format($reg->price) : 0 }}" readonly>
        <p class="des">
            <span>참가 구분 : <b id="gubun_text">{{ !empty($reg->sid) ? $workshopConfig['gubun'][$reg->gubun] : '' }}</b></span>
            <span>등록 구분 : <b id="category_text">{{ !empty($reg->sid) ? $workshopConfig['category'][$reg->category]['name'] : '' }} {{ !empty($reg->sid) ? '-'.number_format($workshopConfig['category'][$reg->category]['price']).'원' : '' }}</b></span>
        </p>
    </div>

@section('reg-script')
    <script>
        $(document).on('click',"input[name='user_chk']",function(){
            $('.category').prop('disabled',false);
            $('.category').prop('checked',false);
            $('#name_kr').prop('readonly',false);
            if($(this).val() == 'Y'){
                $('.user_chk_Y').show();
                $('.user_chk_N').hide();
                if($('#fee_chk').val() == 'N'){
                    $('#category_A').prop('disabled',true);
                    $('#category_B').prop('disabled',true);
                }else{
                    $('#category_C').prop('disabled',true);
                }
                $('#category_D').prop('disabled',true);
                $('#category_E').prop('disabled',true);
                $('#name_kr').prop('readonly',true);
                // $("#user_password").val('');
            }else{
                $('.user_chk_Y').hide();
                $('.user_chk_N').show();
                $('#category_A').prop('disabled',true);
                $('#category_B').prop('disabled',true);
                $('#category_C').prop('disabled',true);
                // $("#user_id").val('');
                // $("#password").val('');
            }
        });

        $(document).on('click',"input[name='gubun']",function(){
            const _name = $(this).data('name');
            $("#gubun_text").html(_name);

            $('#category_F').prop('disabled',true);
            $('#category_G').prop('disabled',true);
            $('#category_F').prop('checked',false);
            $('#category_G').prop('checked',false);
            if($(this).val() == 'G'){
                $('#category_F').prop('disabled',false);
                $('#category_G').prop('disabled',false);
            }
        });

        $(document).on('click',"input[name='category']",function(){
            const _name = $(this).data('name');
            const _price = $(this).data('price');
            $("#category_text").text(_name);
            $("#price_text").text(_price);
            $("#price").val(_price);
        });


        $.validator.addMethod("phoneCheck", function(value, element) {
            // 모든 phone[] 필드 값 가져오기
            let phone1 = $("#phone1").val().trim();
            let phone2 = $("#phone2").val().trim();
            let phone3 = $("#phone3").val().trim();

            return phone1.length > 0 && phone2.length > 0 && phone3.length > 0;
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                @if(CheckUrl() !== 'admin' && empty($reg->sid) )
                agree1: {
                    checkEmpty: true,
                },
                agree2: {
                    checkEmpty: true,
                },
                user_id: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'Y';
                        }
                    },
                    minlength: 6,
                    uidChk: true,
                },
                password: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'Y';
                        }
                    },
                },
                user_password: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'N';
                        }
                    },
                    minlength: 5,
                    maxlength: 8,
                    pwCheck: true,
                },
                @endif
                country: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
                sosok_kr: {
                    isEmpty: true,
                },
                position: {
                    isEmpty: true,
                },
                @if((strpos(request()->getUri(),'mypage') !== false))
                email: {
                    isEmpty: true,
                },
                'phone[]': {
                    phoneCheck: true,
                },
                @else
                email: {
                    isEmpty: true,
                    emailChk: true,
                },
                'phone[]': {
                    phoneCheck: true,
                    phoneChk: true,
                },
                @endif
                gubun: {
                    checkEmpty: true,
                },
                category: {
                    checkEmpty: true,
                },

                captcha_input: {
                    isEmpty: true,
                    captchaChk: true,
                },
            },
            messages: {
                agree1: {
                    checkEmpty: '개인정보 수집 및 이용 동의에 동의해주세요.',
                },
                agree2: {
                    checkEmpty: '개인정보 제3자 제공에 동의해주세요.',
                },
                user_id: {
                    isEmpty: '아이디를 입력해주세요.',
                    minlength: '아이디는 최소 6자 글자로 입력해주세요.',
                    uidChk: '회원인증을 해주세요.',
                },
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                },
                user_password: {
                    isEmpty: "비회원 등록 비밀번호를 입력해주세요.",
                    minlength: '비밀번호는 최소 5자 글자로 입력해주세요.',
                    pwCheck: '비밀번호는 5~8자 영문, 숫자를 조합하여 입력하세요.'
                },

                country: {
                    isEmpty: "국적을 선택해주세요.",
                },
                name_kr: {
                    isEmpty: "성명을 입력해주세요.",
                },
                sosok_kr: {
                    isEmpty: "직장명(소속)을 입력해주세요.",
                },
                position: {
                    isEmpty: "직위를 입력해주세요.",
                },
                email: {
                    isEmpty: "이메일을 입력해주세요.",
                    emailChk: '이메일 중복확인을 해주세요.',
                },
                'phone[]': {
                    phoneCheck: '휴대폰번호를 입력해주세요.',
                    phoneChk: '휴대폰번호 중복확인을 해주세요.',
                },
                gubun: {
                    checkEmpty: "참가 구분을 입력해주세요.",
                },
                category: {
                    checkEmpty: "등록 구분을 입력해주세요.",
                },

                captcha_input: {
                    isEmpty: '자동화 프로그램 입력 방지 코드를 입력 해주세요.',
                    captchaChk: '자동화 프로그램 입력 방지 코드를 확인 해주세요.',
                },
            },
            submitHandler: function () {
                boardSubmit();
            }
        });
    </script>
@endsection