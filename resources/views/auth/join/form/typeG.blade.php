<div class="sub-tit-wrap mt-0">
    <h3 class="sub-tit">기본정보 입력</h3>
</div>
<p class="help-text text-red mb-10">* 표시된 부분은 반드시 기입해주시기 바랍니다.</p>
<ul class="write-wrap">
    @isset($user)
        <li>
            <div class="form-tit">
                회원번호
            </div>
            <div class="form-con">
                {{ $user->sid ?? 0 }}
            </div>
        </li>
    @endisset
    <li>
        <div class="form-tit">
            회원등급
        </div>
        <div class="form-con">
            단체회원
        </div>
    </li>
    @if( isset($user) )

        <li>
            <div class="form-tit">
                <strong class="required">*</strong> 아이디
            </div>
            <div class="form-con">{{ $user->id ?? '' }}</div>
        </li>
    @else

        <li>
            <div class="form-tit">
                <strong class="required">*</strong> 아이디
            </div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" class="form-item" name="id" id="id" value="{{ $user->id ?? '' }}" data-chk="N" onlyEnNum>
                    <a href="javascript:;" id="uid_chk" class="btn btn-small color-type3">중복확인</a>
                </div>
                <p class="help-text text-blue mt-5">* 영문소문자, 숫자만 입력 가능. 최소 6~12자이상 입력하세요.</p>
            </div>
        </li>
        <li>
            <div class="form-tit">
                <strong class="required">*</strong> 비밀번호
            </div>
            <div class="form-con">
                <input type="password" name="password" id="password" class="form-item" onlyEnNum>
                <p class="help-text text-blue mt-5">
                    * 비밀번호는 8~16자 영문, 숫자를 조합하여 입력하세요.
                </p>
            </div>
        </li>
        <li>
            <div class="form-tit">
                <strong class="required">*</strong> 비밀번호 확인
            </div>
            <div class="form-con">
                <input type="password" name="repassword" id="repassword" class="form-item" onlyEnNum>
            </div>
        </li>
    @endif
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 기관명
        </div>
        <div class="form-con">
            <input type="text" name="company" id="company" value="{{ $user->company ?? '' }}" class="form-item">
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 대표이사
        </div>
        <div class="form-con">
            <input type="text" name="ceo" id="ceo" value="{{ $user->ceo ?? '' }}" class="form-item">
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 기관 주소
        </div>
        <div class="form-con">
            <div class="form-group has-btn">
                <input type="text" name="company_zipcode" id="company_zipcode" value="{{ $user->company_zipcode ?? '' }}" readonly class="form-item">
                <a href="#n" onclick="openDaumPostcode('company'); return false" class="btn btn-small color-type3">우편번호 검색</a>
            </div>
            <div class="form-group n2 mt-5">
                <input type="text" name="company_address" id="company_address" value="{{ $user->company_address ?? '' }}" class="form-item">
                <input type="text" name="company_address2" id="company_address2" value="{{ $user->company_address2 ?? '' }}" class="form-item">
            </div>
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 업태, 종목
        </div>
        <div class="form-con">
            <input type="text" name="business" id="business" value="{{ $user->business ?? '' }}" class="form-item">
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 담당자 성명
        </div>
        <div class="form-con">
            <input type="text" name="manager" id="manager" value="{{ $user->manager ?? '' }}" class="form-item">
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 담당자 전화번호
        </div>
        <div class="form-con">
            <?php
            if( !empty($user->managerTel) ){
                $managerTel = explode('-', $user->managerTel);
            }
            ?>
            <div class="form-group form-group-text">
                <select name="managerTel[]" id="managerTel1" class="form-item">
                    @foreach( $userConfig['areaNumber'] as $key => $val )
                        <option value="{{ $key }}" {{ ( $managerTel[0] ?? '' ) == $key ? 'selected' : '' }}>{{ $key }}</option>
                    @endforeach
                </select>
                <span class="text">-</span>
                <input type="text" name="managerTel[]" id="managerTel2" value="{{ $managerTel[1] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
                <span class="text">-</span>
                <input type="text" name="managerTel[]" id="managerTel3" value="{{ $managerTel[2] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
            </div>
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> SMS 수신
        </div>
        <div class="form-con">
            <div class="radio-wrap cst">
                @foreach( $userConfig['receptionYn'] as $key => $val )
                    <label class="radio-group" for="smsReception{{ $key }}">
                        <input type="radio" name="smsReception" id="smsReception{{ $key }}" value="{{ $key }}" {{ ( $user->smsReception ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
                    </label>
                @endforeach
            </div>
            <p class="help-text text-blue mt-5">* 이용목적 : 이벤트/설문/학술정보 등 학회소식을 발송</p>
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 담당자 E-mail
        </div>
        <div class="form-con">
            <input type="text" name="managerEmail" id="managerEmail" value="{{ $user->managerEmail ?? '' }}" class="form-item emailOnly">
        </div>
    </li>
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 이메일 수신
        </div>
        <div class="form-con">
            <div class="radio-wrap cst">
                @foreach( $userConfig['receptionYn'] as $key => $val )
                    <label class="radio-group" for="emailReception{{ $key }}">
                        <input type="radio" name="emailReception" id="emailReception{{ $key }}" value="{{ $key }}" {{ ( $user->emailReception ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
                    </label>
                @endforeach
            </div>
            <p class="help-text text-blue mt-5">* 이용목적 : 이벤트/설문/학술정보 등 학회소식을 발송</p>
        </div>
    </li>
</ul>

@section('reg-script')
    <script>
        $.validator.addMethod("managerTelCheck", function(value, element) {
            // 모든 managerTel[] 필드 값 가져오기
            let managerTel1 = $("#managerTel1").val().trim();
            let managerTel2 = $("#managerTel2").val().trim();
            let managerTel3 = $("#managerTel3").val().trim();

            return managerTel1.length > 0 && managerTel2.length > 0 && managerTel3.length > 0;
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                @if(CheckUrl() === 'admin' || (strpos(request()->getUri(),'mypage') !== false))

                @else
                id: {
                    isEmpty: true,
                    minlength: 6,
                    uidChk: true,
                },
                password: {
                    isEmpty: true,
                    minlength: 8,
                    maxlength: 16,
                    pwCheck: true,
                },
                repassword: {
                    isEmpty: true,
                    equalTo: "input[name=password]",
                },
                @endif
                company: {
                    isEmpty: true,
                },
                ceo: {
                    isEmpty: true,
                },
                company_zipcode: {
                    isEmpty: true,
                },
                company_address: {
                    isEmpty: true,
                },
                company_address2: {
                    isEmpty: true,
                },
                business: {
                    isEmpty: true,
                },
                manager: {
                    isEmpty: true,
                },
                'managerTel[]': {
                    managerTelCheck: true,
                },
                smsReception: {
                    checkEmpty: true,
                },
                managerEmail: {
                    isEmpty: true,
                },
                emailReception: {
                    checkEmpty: true,
                },

                captcha_input: {
                    isEmpty: true,
                    captchaChk: true,
                },
            },
            messages: {

                id: {
                    isEmpty: '아이디를 입력해주세요.',
                    minlength: '아이디는 최소 6자 글자로 입력해주세요.',
                    uidChk: '아이디 중복체크를 해주세요.',
                },
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                    minlength: '비밀번호는 최소 8자 글자로 입력해주세요.',
                    pwCheck: '비밀번호는 8~16자 영문, 숫자를 조합하여 입력하세요.'
                },
                repassword: {
                    isEmpty: "비밀번호 확인을 입력해주세요.",
                    equalTo: "입력하신 비밀번호와 동일하게 입력해주세요.",
                },

                company: {
                    isEmpty: "기관명을 입력해주세요.",
                },
                ceo: {
                    isEmpty: "대표이사를 입력해주세요.",
                },
                company_zipcode: {
                    isEmpty: "기관 주소를 입력해주세요.",
                },
                company_address: {
                    isEmpty: "기관 상세주소를 입력해주세요.",
                },
                company_address2: {
                    isEmpty: "기관 상세주소를 입력해주세요.",
                },
                business: {
                    isEmpty: "업태,종목을 입력해주세요.",
                },
                manager: {
                    isEmpty: "담당자 성명을 입력해주세요.",
                },
                'managerTel[]': {
                    managerTelCheck: '담당자 전화번호를 입력해주세요.',
                },
                smsReception: {
                    checkEmpty: "SMS 수신동의를 선택해주세요.",
                },
                managerEmail: {
                    isEmpty: "담당자 E-mail을 입력해주세요.",
                },
                emailReception: {
                    checkEmpty: "이메일 수신동의를 선택해주세요.",
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