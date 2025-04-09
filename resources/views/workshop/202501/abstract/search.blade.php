@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="pc-only-wrap m-show">
                <img src="/target/202501/assets/image/sub/img_pc_only.png" alt="">
                <p>YEP 초록접수는 <span>PC</span>에서만 가능합니다.</p>
            </div>

            <div class="m-hide">
                <div class="sub-tab-wrap">
                    <ul class="sub-tab-menu">
                        <li ><a href="{{ route('abstract.info',['work_code'=>$work_code]) }}"><span>YEP 초록접수 안내</span></a></li>
                        <li ><a href="{{ route('abstract.check',['work_code'=>$work_code]) }}"><span>YEP 초록접수</span></a></li>
                        <li class="on"><a href="{{ route('abstract.search',['work_code'=>$work_code]) }}"><span>YEP 초록접수 조회 및 수정</span></a></li>
                    </ul>
                </div>
                <div class="img-border-box">
                    <img src="/target/202501/assets/image/sub/ic_check.png" alt="">
                    <div class="text-wrap">
                        <ul class="list-type list-type-check">
                            <li class="text-orange"><strong>초록 제출은 PC에서만 접수 가능합니다.</strong></li>
                            <li class="text-orange"><strong>초록제출은 사전등록 > 최종 입금 완료하신 분들만 제출 가능합니다. </strong></li>
                            <li class="list-black">대한환경공학회 회원으로 사전등록 접수한 경우 : <strong class="text-orange">학회 홈페이지 로그인 계정으로 인증</strong> 가능</li>
                            <li class="list-black">대한환경공학회 비회원으로 사전등록 접수한 경우 : <strong class="text-orange">성함 + 접수 시 지정한 비밀번호로 인증</strong> 가능
                                <ul class="list-type list-type-star">
                                    <li>사전등록 완료하였으나, 조회가 되지 않을 경우 사무국으로 연락 부탁 드립니다. (TEL. <a href="tel:+82-02-383-9652">02-383-9652</a>  E-MAIL : <a href="mailto:kosenv@kosenv.or.kr">kosenv@kosenv.or.kr</a>)</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <form id="register-frm" method="post" action="{{ route('abstract.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="" data-case="abstract-search">
                    <fieldset>
                        <legend class="hide">초록접수 조회</legend>
                        <div class="write-wrap">
                            <ul>
                                <li>
                                    <div class="form-con">
                                        <div class="radio-wrap cst text-center">
                                            <label class="radio-group"><input type="radio" name="user_chk" value="Y" >대한환경공학회 회원</label>
                                            <label class="radio-group"><input type="radio" name="user_chk" value="N" >대한환경공학회 비회원</label>
                                        </div>
                                    </div>
                                </li>
                                <li >
                                    <div class="form-tit"><strong class="required">*</strong> 참가구분</div>
                                    <div class="form-con">
                                        <select name="gubun" id="gubun" class="form-item">
                                            <option value="">참가 구분 선택</option>
                                            @foreach($workshopConfig['gubun'] as $key => $val)
                                                <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li class="user_chk_Y">
                                    <div class="form-tit"><strong class="required">*</strong> 학회 홈페이지 ID</div>
                                    <div class="form-con">
                                        <input type="text" name="user_id" id="user_id" class="form-item">
                                    </div>
                                </li>
                                <li class="user_chk_Y">
                                    <div class="form-tit"><strong class="required">*</strong> 학회 홈페이지 PW</div>
                                    <div class="form-con">
                                        <input type="password" name="password" id="password" class="form-item">
                                    </div>
                                </li>
                                <li class="user_chk_N" style="display: none;">
                                    <div class="form-tit"><strong class="required">*</strong> 성함</div>
                                    <div class="form-con">
                                        <input type="text" name="name_kr" id="name_kr" class="form-item">
                                    </div>
                                </li>
                                <li class="user_chk_N" style="display: none;">
                                    <div class="form-tit"><strong class="required">*</strong> 비회원 등록 비밀번호</div>
                                    <div class="form-con">
                                        <input type="password" name="user_password" id="user_password" class="form-item">
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="btn-wrap text-center">
                            <a href="javascript:$(form).submit();" class="btn btn-type1 color-type9">초록 접수 조회하기 <img src="/target/202501/assets/image/sub/img_btn_abstract.png" alt="" class="right"></a>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('abstract.data',['work_code'=>$work_code]) }}';

        //회원 인증
        $(document).on('click', "input[name='user_chk']", function() {
            const _user_chk = $(this).val();

            if(_user_chk == 'Y') {
                $(".user_chk_Y").show();
                $(".user_chk_N").hide();
            }else{
                $(".user_chk_Y").hide();
                $(".user_chk_N").show();
            }
        });

        $.validator.addMethod('gubunChk', function (value, element) {
            return $("#gubun").val() !== 'A';
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                user_chk:{
                    checkEmpty: true,
                },
                gubun:{
                    isEmpty: true,
                    gubunChk: true,
                },
                user_id: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'Y';
                        }
                    },
                },
                password: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'Y';
                        }
                    },
                },
                name_kr: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'N';
                        }
                    },
                },
                user_password: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='user_chk']:checked").val() === 'N';
                        }
                    },
                },
            },
            messages: {
                user_chk: {
                    checkEmpty: '회원/비회원을 체크해주세요.',
                },
                gubun:{
                    isEmpty: '참가구분을 선택해주세요.',
                    gubunChk: '초록접수 대상자가 아닙니다.',
                },
                user_id: {
                    isEmpty: '학회 홈페이지 ID를 입력해주세요.',
                },
                password: {
                    isEmpty: '학회 홈페이지 PW를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '성함을 입력해주세요.',
                },
                user_password: {
                    isEmpty: '비회원 등록 비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
