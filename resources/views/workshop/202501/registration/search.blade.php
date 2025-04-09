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
                <img src="/target/202501/assets/image/sub/ic_confirm.png" alt="">
                <div class="text-wrap">
                    <ul class="list-type list-type-check">
                        <li>대한환경공학회 회원으로 사전등록 접수한 경우 : <strong class="text-orange">학회 홈페이지 로그인 계정으로 조회</strong> 가능</li>
                        <li>대한환경공학회 비회원으로 사전등록 접수한 경우 : <strong class="text-orange">성함 + 접수 시 지정한 비밀번호로 조회</strong> 가능
                            <ul class="list-type list-type-star">
                                <li>사전등록 완료하였으나, 조회가 되지 않을 경우 사무국으로 연락 부탁 드립니다. (TEL. <a href="tel:+82-{{ env('APP_DASHTEL') }}">{{ env('APP_DASHTEL') }}</a>  E-MAIL : <a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a>)</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <form id="register-frm" method="post" action="{{ route('registration.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-check">
                <fieldset>
                    <legend class="hide">사전등록 조회</legend>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-con">
                                    <div class="radio-wrap cst text-center">
                                        <label class="radio-group"><input type="radio" name="user_chk" value="Y">대한환경공학회 회원</label>
                                        <label class="radio-group"><input type="radio" name="user_chk" value="N">대한환경공학회 비회원</label>
                                    </div>
                                </div>
                            </li>
                            <li class="user_chk_Y" >
                                <div class="form-tit"><strong class="required">*</strong> 학회 홈페이지 ID</div>
                                <div class="form-con">
                                    <input type="text" name="user_id" id="user_id" class="form-item">
                                </div>
                            </li>
                            <li class="user_chk_Y" >
                                <div class="form-tit"><strong class="required">*</strong> 학회 홈페이지 PW</div>
                                <div class="form-con">
                                    <input type="password" name="password" id="password" class="form-item">
                                </div>
                            </li>
                            <li class="user_chk_N" style="display:none;">
                                <div class="form-tit"><strong class="required">*</strong> 성함</div>
                                <div class="form-con">
                                    <input type="text" name="name_kr" id="name_kr" class="form-item">
                                </div>
                            </li>
                            <li class="user_chk_N" style="display:none;">
                                <div class="form-tit"><strong class="required">*</strong> 비회원 등록 비밀번호</div>
                                <div class="form-con">
                                    <input type="password" name="user_password" id="user_password" class="form-item">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:$(form).submit();" class="btn btn-type1 color-type2">사전등록 조회하기</a>
                    </div>
                </fieldset>
            </form>

        </div>
    </article>

@endsection

@section('addScript')
<script>
    const form = '#register-frm';
    const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

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

    defaultVaildation();

    $(form).validate({
        rules: {
            user_chk:{
                checkEmpty: true,
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