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

            <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-{{ !empty($reg->sid) ? 'update':'create' }}">
                <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>

                <fieldset>
                    <legend class="hide">사전등록</legend>
                    <div class="write-tit-wrap">
                        <img src="/target/202501/assets/image/sub/ic_write.png" alt="">
                        <div class="text-wrap">
                            <p class="tit">{{ $workshop->subject ?? '' }} 사전등록 신청서</p>
                            <p class="des">사전등록 마감일 : {!! $endDate ?? '' !!}</p>
                        </div>
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-tit">개인정보 수집 및 이용 동의</h4>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            <ul class="list-type list-type-dot">
                                <li>(사)대한환경공학회는 제8회 전문가그룹 학술대회 사전등록, 초록등록, 고지사항 전달 등을 위해 아래와 같이 개인정보를 수집·이용합니다.</li>
                                <li>귀하는 (사)대한환경공학회의 서비스 이용에 필요한 최소한의 개인정보 수집·이용에 동의하지 않을 수 있으나, 동의를 거부할 경우 제8회 전문가그룹 학술대회
                                    사전등록 서비스 이용이 불가합니다.</li>
                            </ul>
                            <div class="table-wrap">
                                <table class="cst-table">
                                    <caption class="hide">환불규정</caption>
                                    <colgroup>
                                        <col style="width: 33.3333%;">
                                        <col style="width: 33.3333%;">
                                        <col>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">수집 목적</th>
                                        <th scope="col">수집 항목</th>
                                        <th scope="col">수집 근거</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>사전 등록 </td>
                                        <td>성명, 국적, 소속, 직위, 이메일주소, 휴대폰번호</td>
                                        <td rowspan="3">개인정보 보호법 제15조 제1항</td>
                                    </tr>
                                    <tr>
                                        <td>초록 등록</td>
                                        <td>논문제목, 저자명, 초록, 주제어, 사사, 발표자소개</td>
                                    </tr>
                                    <tr>
                                        <td>서비스 변경사항 및 고지사항 전달</td>
                                        <td>성명, 이메일주소, 휴대폰번호</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-wrap term-check text-center cst">
                        <label class="checkbox-group"><input type="checkbox" name="agree1" id="agree1" value="Y" {{ !empty($reg->sid) ? 'checked':'' }}>개인정보 수집 이용에 동의합니다.</label>
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-tit">개인정보 제3자 제공 동의</h4>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            <ul class="list-type list-type-dot">
                                <li>(사)대한환경공학회는 회원님의 개인정보를 개인정보 처리방침에서 고지한 제3자 제공 범위 내에서 제공하며, 정보주체의 사전 동의 없이 동 범위를
                                    초과하여 제3자에게 제공하지 않습니다.</li>
                            </ul>
                            <div class="table-wrap">
                                <table class="cst-table">
                                    <caption class="hide">환불규정</caption>
                                    <colgroup>
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">제공받는 자 </th>
                                        <th scope="col">제공 목적</th>
                                        <th scope="col">제공 항목</th>
                                        <th scope="col">보유기간</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>대전관광공사</td>
                                        <td>대전MICE 결과보고서</td>
                                        <td>성명, 국적, 소속, 이메일</td>
                                        <td>수집일로부터 1년</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox-wrap term-check text-center cst">
                        <label class="checkbox-group"><input type="checkbox" name="agree2" id="agree2" value="Y" {{ !empty($reg->sid) ? 'checked':'' }}>개인정보 제3자 제공에 동의합니다.</label>
                    </div>

                    @include('workshop.'.$work_code.'.'.'registration.form.regist-frm')

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
                        <a href="javascript:$(form).submit();" class="btn btn-type1 color-type4 btn-line">{{ !empty($reg->sid) && ($reg->status ?? '') == 'Y' ? '수정하기' : '미리보기' }}</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
                    </div>
                </fieldset>
            </form>
            <!-- //e:약관동의 -->
        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

        //adminPass 체크 - 일반 사용자는 사용X
        const _adminPass = '{{ $workshop->adminPass }}';
        const _isAdmin = {{ isAdmin() ? 'true' : 'false' }};
        if(_adminPass == 'Y' && _isAdmin === false ){
            alert("현재 접근 불가능합니다.");
            window.location.href = "{{ route('registration.info',['work_code'=>$work_code]) }}";
        }

        //등록기간 체크
        const _dueCheck = {{ $isRegistDue ? 'true' : 'false' }};
        if(_dueCheck === false){
            alert("현재 사전등록 기간이 아닙니다.");
            window.location.href = "{{ route('registration.info',['work_code'=>$work_code]) }}";
        }

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