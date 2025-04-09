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
                    <ul class="list-type list-type-star">
                        <li>후원신청 완료하였으나, 조회가 되지 않을 경우 사무국으로 연락 부탁 드립니다. (TEL. <a href="+82-02-383-9652">02-383-9652</a>  E-MAIL : <a href="mailto:kosenv@kosenv.or.kr">kosenv@kosenv.or.kr</a>)</li>
                    </ul>
                </div>
            </div>
            <form id="register-frm" method="post" action="{{ route('support.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($sup->sid) ? $sup->sid : '' }}" data-case="support-search">
                <fieldset>
                    <legend class="hide">후원신청 조회</legend>
                    <div class="write-wrap">
                        <ul>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 회사명</div>
                                <div class="form-con">
                                    <input type="text" name="company" id="company" class="form-item">
                                </div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 담당자명</div>
                                <div class="form-con">
                                    <input type="text" name="manager" id="manager" class="form-item">
                                </div>
                            </li>
                            <li>
                                <div class="form-tit"><strong class="required">*</strong> 담당자 E-MAIL</div>
                                <div class="form-con">
                                    <input type="text" name="email" id="email" class="form-item emailOnly">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:$(form).submit();" class="btn btn-type1 color-type11">후원신청 조회하기 <img src="/target/202501/assets/image/sub/img_btn_abstract.png" alt="" class="right"></a>
                    </div>
                </fieldset>
            </form>

        </div>
    </article>

@endsection

@section('addScript')
<script>
    const form = '#register-frm';
    const dataUrl = '{{ route('support.data',['work_code'=>$work_code]) }}';

    defaultVaildation();

    $(form).validate({
        rules: {
            company:{
                isEmpty: true,
            },
            manager:{
                isEmpty: true,
            },
            email:{
                isEmpty: true,
            },
        },
        messages: {
            company: {
                isEmpty: '회사명을 입력해주세요.',
            },
            manager: {
                isEmpty: '담당자명을 입력해주세요.',
            },
            email: {
                isEmpty: '담당자 E-MAIL을 입력해주세요.',
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