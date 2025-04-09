@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="/target/202501/assets/css/common.css">
@endsection

@section('contents')
    <form id="register-frm" method="post" action="{{ route('registration.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-update">
        <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
        <input type="hidden" name="price" id="price" value="{{ $reg->price ?? 0 }}" readonly>
        <input type="hidden" name="status" id="status" value="{{ $reg->status ?? '' }}" readonly>

        <fieldset>
            @include('workshop.'.$work_code.'.'.'registration.form.regist-frm')

        </fieldset>

        <div class="btn-wrap text-center">
            <a href="javascript:$(form).submit();" class="btn btn-type1 color-type4 btn-line">수정하기</a>
            <a href="javascript:self.close();" class="btn btn-type1 color-type4">취소</a>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';
        
        //회원 인증
        $(document).on('click', '#uid_chk', function() {
            const uid = $('input[name=user_id]').val();
            const pwd = $('input[name=password]').val();

            if(isEmpty(uid)) {
                alert('아이디를 입력해주세요.');
                return;
            }
            if(isEmpty(pwd)) {
                alert('비밀번호를 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'uid-check',
                'user_id': uid,
                'password': pwd,
                'reg_sid': $("#register-frm").data('sid'),
            });
        });

        //인증 초기화
        $(document).on('click', '#uid_reset', function() {
            callAjax(dataUrl, {
                'case': 'uid-reset',
            });
        });

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        // 이메일 중복체크
        $.validator.addMethod('emailChk', function (value, element) {
            return $(element).data('chk') === 'Y';
        });

        $(document).on('click', '#email_chk', function() {
            const _email = $('input[name=email]').val();

            if(isEmpty(_email)) {
                alert('이메일을 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'email-check',
                'email': _email,
                'reg_sid': $("#register-frm").data('sid'),
            });
        });

        $(document).on('keyup', 'input[name=email]', function() {
            $(this).data('chk', 'N');
        });

        // 휴대폰 중복체크
        // $.validator.addMethod('phoneChk', function (value, element) {
        //     return $(element).data('chk') === 'Y';
        // });

        // 휴대폰 중복체크
        $.validator.addMethod('phoneChk', function (value, element) {
            return $("#phone1").data('chk') === 'Y' && $("#phone2").data('chk') === 'Y' && $("#phone3").data('chk') === 'Y' ;
        });

        $(document).on('click', '#phone_chk', function() {
            const _phone1 = $('#phone1').val();
            const _phone2 = $('#phone2').val();
            const _phone3 = $('#phone3').val();

            if(isEmpty(_phone1)) {
                alert('휴대폰 번호를 입력해주세요.');
                return;
            }
            if(isEmpty(_phone2)) {
                alert('휴대폰 번호를 입력해주세요.');
                return;
            }
            if(isEmpty(_phone3)) {
                alert('휴대폰 번호를 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'phone-check',
                'phone1': _phone1,
                'phone2': _phone2,
                'phone3': _phone3,
                'reg_sid': $("#register-frm").data('sid'),
            });
        });

        $(document).on('keyup', "input[name='phone[]']", function() {
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
