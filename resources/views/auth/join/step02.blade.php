@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="step-list-wrap">
                <ul class="step-list">
                    <li>Step 1. 약관동의</li>
                    <li class="on">Step 2. 정보입력</li>
                    <li>Step 3. 가입완료</li>
                </ul>
            </div>

            <!-- s:회원가입 Form -->
            <div class="write-form-wrap">
                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($sid) ? $sid : '' }}" data-case="register-step2">
                    <input type="hidden" name="gubun" value="{{ request()->gubun ?? '' }}" readonly>
                    <input type="hidden" name="step" value="{{ request()->step ?? '' }}" readonly>

                    <fieldset>
                        <legend class="hide">회원가입</legend>

                        @include('auth.join.form.type'.$gubun)

                        <div class="sub-tit-wrap">
                            <h3 class="sub-tit">자동화 프로그램 입력 방지</h3>
                        </div>
                        <p class="help-text text-red mb-10">*정보 보안을 위해 아래 적힌 문자를 입력하신 후 등록 가능합니다.</p>
                        <ul class="write-wrap">
                            <li>
                                <div class="form-con">
                                    @include('components.captcha')
                                </div>
                            </li>
                        </ul>

                        <div class="btn-wrap text-center">
                            <a href="{{ route('main') }}" class="btn btn-type1 color-type7">취소</a>
                            <button type="submit" class="btn btn-type1 color-type5">회원 가입 완료</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- //e:회원가입 Form -->
        </div>
    </article>
@endsection

@section('addScript')
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';

        $(document).on('click', '#uid_chk', function() {
            const uid = $('input[name=id]').val();

            let obj = {
                'case': true,
                'focus': 'input[name=id]'
            };
            if(isEmpty(uid)) {
                alert('아이디를 입력해주세요.');
                return;
            }
            callAjax(dataUrl, {
                'case': 'uid-check',
                'id': uid,
            });
        });

        $(document).on('keyup', 'input[name=id]', function() {
            $(this).data('chk', 'N');
        });

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }

        function openDaumPostcode(kind){
            if( kind == "company" ){
                var space = "company_";
            }else{
                var space = "home_";
            }

            new daum.Postcode({
                oncomplete: function(data) {
                    $(":text[name='"+space+"zipcode']").val(data.zonecode);
                    $(":text[name='"+space+"address']").val(data.address).focus();
                }
            }).open();
        }
    </script>

    @yield('reg-script')
@endsection