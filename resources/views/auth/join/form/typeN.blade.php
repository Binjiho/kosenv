<div class="sub-tit-wrap mt-0">
    <h3 class="sub-tit">기본정보 입력</h3>
</div>
<p class="help-text text-red mb-10">* 표시된 부분은 반드시 기입해주시기 바랍니다.</p>
<ul class="write-wrap">
    {{--  일반회원 가입시 무조건 정회원  --}}
    <input type="hidden" name="grade" value="{{ $user->grade ?? 'A' }}" readonly>
    {{--  //일반회원 가입시 무조건 정회원  --}}

    @isset($user)
    <li>
        <div class="form-tit">
            회원번호
        </div>
        <div class="form-con">
            {{ $user->sid ?? 0 }}
        </div>
    </li>

    <li>
        <div class="form-tit">
            회원등급
        </div>
        <div class="form-con">
            {{ $userConfig['gubun'][ $user->gubun ?? '' ] }}
        </div>
    </li>
    @endisset

@if( isset($user) )
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 회원 세부 등급
        </div>
        <div class="form-con">
             {{ $userConfig['grade'][ $user->gubun ?? '' ][$user->grade ?? ''] }}
        </div>
    </li>

    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 아이디
        </div>
        <div class="form-con">{{ $user->id }}</div>
    </li>
@else
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 아이디
        </div>
        <div class="form-con">
            <div class="form-group has-btn">
                <input type="text" class="form-item" name="id" id="id" value="{{ $user->id ?? '' }}" data-chk="N" maxlength="12" onlySmallEnNum>
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

@if( isset($user) && (strpos(request()->getUri(),'mypage') !== false) )
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 성명(한글)
        </div>
        <div class="form-con">
            {{ $user->name_kr ?? '' }}
            <input type="hidden" name="name_kr" id="name_kr" value="{{ $user->name_kr ?? '' }}" class="form-item ">
        </div>
    </li>
@else
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 성명(한글)
        </div>
        <div class="form-con">
            <input type="text" name="name_kr" id="name_kr" value="{{ $user->name_kr ?? '' }}" class="form-item " onlyKo>
        </div>
    </li>
@endif
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 성명(영문)
    </div>
    <div class="form-con">
        <input type="text" name="name_en" id="name_en" value="{{ $user->name_en ?? '' }}" class="form-item " enname>
    </div>
</li>
@if( isset($user) && (strpos(request()->getUri(),'mypage') !== false) )
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 생년월일
        </div>
        <div class="form-con">
            {{ $user->birth ?? '' }}
            <input type="hidden" name="birth" id="birth" value="{{ $user->birth ?? '' }}" class="form-item ">
        </div>
    </li>
@else
    <li>
        <div class="form-tit">
            <strong class="required">*</strong> 생년월일
        </div>
        <div class="form-con">
            <input type="text" name="birth" id="birth" value="{{ $user->birth ?? '' }}" class="form-item " maxlength="10" birthHyphen>
            <p class="help-text mt-5">ex) 20100101</p>
        </div>
    </li>
@endif
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 성별
    </div>

    <div class="form-con">
        <div class="radio-wrap cst">
            @foreach( $userConfig['sex'] as $key => $val )
            <label class="radio-group" for="sex{{ $key }}">
                <input type="radio" name="sex" id="sex{{ $key }}" value="{{ $key }}" {{ ( $user->sex ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
            </label>
            @endforeach
        </div>
    </div>
</li>
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 이메일
    </div>
    <div class="form-con">
        <input type="text" name="email" id="email" value="{{ $user->email ?? '' }}" class="form-item emailOnly">
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
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 휴대폰 번호
    </div>
    <?php
    if( !empty($user->phone) ){
        $phone = explode('-', $user->phone);
    }
    ?>
    <div class="form-con">
        <div class="form-group form-group-text">
            <input type="text" name="phone[]" id="phone1" value="{{ $phone[0] ?? '' }}" class="form-item " maxlength="3" onlyNumber>
            <span class="text">-</span>
            <input type="text" name="phone[]" id="phone2" value="{{ $phone[1] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
            <span class="text">-</span>
            <input type="text" name="phone[]" id="phone3" value="{{ $phone[2] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
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
        <strong class="required">*</strong> 우편물 수령지
    </div>
    <div class="form-con">
        <div class="radio-wrap cst">
            @foreach( $userConfig['post'] as $key => $val )
            <label class="radio-group" for="post{{ $key }}">
                <input type="radio" name="post" id="post{{ $key }}" value="{{ $key }}" {{ ( $user->post ?? '' ) == $key ? 'checked' : ''  }}>{{ $val }}
            </label>
            @endforeach
        </div>
    </div>
</li>
</ul>

<div class="sub-tit-wrap">
<h3 class="sub-tit">직장정보 입력</h3>
</div>
<ul class="write-wrap">
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 직장명
    </div>
    <div class="form-con">
        <input type="text" name="company" id="company" value="{{ $user->company ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 부서
    </div>
    <div class="form-con">
        <input type="text" name="department" id="department" value="{{ $user->department ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 직종
    </div>
    <div class="form-con">
        <select name="job" id="job" class="form-item">
            <option value="">직종 선택</option>
            @foreach( $userConfig['job'] as $key => $val )
            <option value="{{ $key }}" {{ ( $user->job ?? '' ) == $key ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
    </div>
</li>
<li class="positionBox" {!! !isset($user->job) ? 'style="display:none"' : '' !!}>
    <div class="form-tit">
        <strong class="required">*</strong> 직위
    </div>
    <div class="form-con">
        <div class="form-group form-group-text">
            <select name="position" id="position" class="form-item" {!! ( $user->job ?? '' ) != 'A' ? 'style="display:none"' : '' !!}>
                <option value="">직위 선택</option>
                @foreach( $userConfig['position'] as $key => $val )
                <option value="{{ $key }}" {{ ( $user->position ?? '' ) == $key ? 'selected' : '' }}>{{ $val }}</option>
                @endforeach
            </select>

            <input type="text" name="position_etc" id="position_etc" value="{{ $user->position_etc ?? '' }}" class="form-item" placeholder="" {!! ( $user->job ?? '' ) == 'A' || !isset($user->job) ? 'style="display:none"' : '' !!}>
        </div>
    </div>
</li>
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 주소
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
        전화번호
    </div>
    <div class="form-con">
        <?php
        if( !empty($user->companyTel) ){
            $companyTel = explode('-', $user->companyTel);
        }
        ?>
        <div class="form-group form-group-text">
            <select name="companyTel[]" id="companyTel1" class="form-item">
                @foreach( $userConfig['areaNumber'] as $key => $val )
                <option value="{{ $key }}" {{ ( $companyTel[0] ?? '' ) == $key ? 'selected' : '' }}>{{ $key }}</option>
                @endforeach
            </select>
            <span class="text">-</span>
            <input type="text" name="companyTel[]" id="companyTel2" value="{{ $companyTel[1] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
            <span class="text">-</span>
            <input type="text" name="companyTel[]" id="companyTel3" value="{{ $companyTel[2] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
        </div>
    </div>
</li>
<li>
    <div class="form-tit">
        팩스번호
    </div>
    <div class="form-con">
        <?php
        if( !empty($user->companyFax) ){
            $companyFax = explode('-', $user->companyFax);
        }
        ?>
        <div class="form-group form-group-text">
            <select name="companyFax[]" id="companyFax1" class="form-item">
                @foreach( $userConfig['areaNumber'] as $key => $val )
                <option value="{{ $key }}" {{ ( $companyFax[0] ?? '' ) == $key ? 'selected' : '' }}>{{ $key }}</option>
                @endforeach
            </select>
            <span class="text">-</span>
            <input type="text" name="companyFax[]" id="companyFax2" value="{{ $companyFax[1] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
            <span class="text">-</span>
            <input type="text" name="companyFax[]" id="companyFax3" value="{{ $companyFax[2] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
        </div>
    </div>
</li>
</ul>

<div class="sub-tit-wrap">
<h3 class="sub-tit">자택정보 입력</h3>
</div>
<ul class="write-wrap">
<li>
    <div class="form-tit">
        <strong class="required">*</strong> 주소
    </div>
    <div class="form-con">
        <div class="form-group has-btn">
            <input type="text" name="home_zipcode" id="home_zipcode" value="{{ $user->home_zipcode ?? '' }}" readonly class="form-item">
            <a href="#n" onclick="openDaumPostcode('home'); return false" class="btn btn-small color-type3">우편번호 검색</a>
        </div>
        <div class="form-group n2 mt-5">
            <input type="text" name="home_address" id="home_address" value="{{ $user->home_address ?? '' }}" class="form-item">
            <input type="text" name="home_address2" id="home_address2" value="{{ $user->home_address2 ?? '' }}" class="form-item">
        </div>
    </div>
</li>
<li>
    <div class="form-tit">
        전화번호
    </div>
    <div class="form-con">
        <?php
        if( !empty($user->homeTel) ){
            $homeTel = explode('-', $user->homeTel);
        }
        ?>
        <div class="form-group form-group-text">
            <select name="homeTel[]" id="homeTel1" class="form-item">
                @foreach( $userConfig['areaNumber'] as $key => $val )
                <option value="{{ $key }}" {{ ( $homeTel[0] ?? '' ) == $key ? 'selected' : '' }}>{{ $key }}</option>
                @endforeach
            </select>
            <span class="text">-</span>
            <input type="text" name="homeTel[]" id="homeTel2" value="{{ $homeTel[1] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
            <span class="text">-</span>
            <input type="text" name="homeTel[]" id="homeTel3" value="{{ $homeTel[2] ?? '' }}" class="form-item " maxlength="4" onlyNumber>
        </div>
    </div>
</li>
</ul>

<div class="sub-tit-wrap">
<h3 class="sub-tit">학력사항 입력</h3>
</div>
<ul class="write-wrap">
<li>
    <div class="form-tit">
        학위
    </div>
    <div class="form-con">
        <select name="degree" id="degree" class="form-item">
            <option value="">학위 선택</option>
            @foreach( $userConfig['degree'] as $key => $val )
            <option value="{{ $key }}" {{ ( $user->degree ?? '' ) == $key ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
    </div>
</li>
<li>
    <div class="form-tit">
        졸업(예정)연도
    </div>
    <div class="form-con">
        <div class="form-group form-group-text">
            <input type="text" name="graduate" id="graduate" value="{{ $user->graduate ?? '' }}" class="form-item w-40p " maxlength="4" onlyNumber>
            <span class="text">년</span>
        </div>
    </div>
</li>
<li>
    <div class="form-tit">
        취득국가
    </div>
    <div class="form-con">
        <input type="text" name="degreeCountry" id="degreeCountry" value="{{ $user->degreeCountry ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        취득기관
    </div>
    <div class="form-con">
        <input type="text" name="degreeAgency" id="degreeAgency" value="{{ $user->degreeAgency ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        지도교수
    </div>
    <div class="form-con">
        <input type="text" name="tutor" id="tutor" value="{{ $user->tutor ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        국문논문명
    </div>
    <div class="form-con">
        <input type="text" name="journalKor" id="journalKor" value="{{ $user->journalKor ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
<li>
    <div class="form-tit">
        영문논문명
    </div>
    <div class="form-con">
        <input type="text" name="journalEng" id="journalEng" value="{{ $user->journalEng ?? '' }}" class="form-item" placeholder="">
    </div>
</li>
</ul>

@section('reg-script')
    <script>
        $("#job").change(function(){

            var value = $(this).val();

            switch(value){
                case "" : $(".positionBox").hide(); $(".positionBox").find("select, input").val("").hide(); break;
                case "A" : $(".positionBox, #position").show(); $("#position_etc").val("").hide(); break;
                default : $(".positionBox, #position_etc").show(); $("#position").val("").hide(); break;
            }
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
                name_kr: {
                    isEmpty: true,
                },
                @endif

                name_en: {
                    isEmpty: true,
                },
                @if(CheckUrl() === 'admin' || (strpos(request()->getUri(),'mypage') !== false))

                @else
                birth: {
                    isEmpty: true,
                },
                @endif
                sex: {
                    checkEmpty: true,
                },
                email: {
                    isEmpty: true,
                },
                emailReception: {
                    checkEmpty: true,
                },
                'phone[]': {
                    phoneCheck: true,
                },
                smsReception: {
                    checkEmpty: true,
                },
                post: {
                    checkEmpty: true,
                },

                company: {
                    isEmpty: true,
                },
                department: {
                    isEmpty: true,
                },
                job: {
                    isEmpty: true,
                },
                position: {
                    isEmpty: {
                        depends: function(element) {
                            return $("#position").is(":visible");
                        }
                    }
                },
                position_etc: {
                    isEmpty: {
                        depends: function(element) {
                            return $("#position_etc").is(":visible");
                        }
                    }
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
                home_zipcode: {
                    isEmpty: true,
                },
                home_address: {
                    isEmpty: true,
                },
                home_address2: {
                    isEmpty: true,
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
                name_kr: {
                    isEmpty: "성명(한글)을 입력해주세요.",
                },
                name_en: {
                    isEmpty: "성명(영문)을 입력해주세요.",
                },
                birth: {
                    isEmpty: "생년월일을 입력해주세요.",
                },
                sex: {
                    checkEmpty: "성별을 선택해주세요.",
                },
                email: {
                    isEmpty: "이메일을 입력해주세요.",
                },
                emailReception: {
                    checkEmpty: "이메일 수신동의를 선택해주세요.",
                },
                'phone[]': {
                    phoneCheck: "휴대폰 번호를 입력해주세요.",
                },
                smsReception: {
                    checkEmpty: "SMS 수신동의를 선택해주세요.",
                },
                post: {
                    checkEmpty: "우편물 수령지를 선택해주세요.",
                },

                company: {
                    isEmpty: "직장명을 입력해주세요.",
                },
                department: {
                    isEmpty: "부서를 입력해주세요.",
                },
                job: {
                    isEmpty: "직종을 선택해주세요.",
                },
                position: {
                    isEmpty: "직위를 선택해주세요.",
                },
                position_etc: {
                    isEmpty: "직위를 입력해주세요.",
                },
                company_zipcode: {
                    isEmpty: "직장정보 주소를 입력해주세요.",
                },
                company_address: {
                    isEmpty: "직장정보 상세주소를 입력해주세요.",
                },
                company_address2: {
                    isEmpty: "직장정보 상세주소를 입력해주세요.",
                },
                home_zipcode: {
                    isEmpty: "자택정보 주소를 입력해주세요.",
                },
                home_address: {
                    isEmpty: "자택정보 상세주소를 입력해주세요.",
                },
                home_address2: {
                    isEmpty: "자택정보 상세주소를 입력해주세요.",
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