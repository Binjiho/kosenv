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
                    <li class="on"><a href="{{ route('support',['work_code'=>$work_code]) }}"><span>후원신청</span></a></li>
                    <li><a href="{{ route('support.search',['work_code'=>$work_code]) }}"><span>후원신청 조회 및 수정</span></a></li>
                </ul>
            </div>

            <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($sup->sid) ? $sup->sid : '' }}" data-case="support-{{ !empty($sup->sid) ? 'update':'create' }}">
                <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
                <input type="hidden" name="price" id="price" value="{{ $sup->price ?? 0 }}" readonly>

                <fieldset>
                    <legend class="hide">사전등록</legend>
                    <div class="write-tit-wrap bg-mint">
                        <img src="/target/202501/assets/image/sub/ic_write.png" alt="">
                        <div class="text-wrap">
                            <p class="tit">{{ $workshop->subject ?? '' }} 후원 신청서</p>
                            <p class="des">후원신청 마감일 : {!! $endDate ?? '' !!}
                        </div>
                    </div>

                    @include('workshop.'.$work_code.'.'.'support.form.regist-frm')

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
                        <a href="javascript:;" class="btn btn-type1 color-type4 btn-line" id="post">{{ !empty($sup->sid) && ($sup->status ?? '') == 'Y' ? '수정하기' : '미리보기' }}</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
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

        //adminPass 체크 - 일반 사용자는 사용X
        const _adminPass = '{{ $workshop->adminPass }}';
        const _isAdmin = {{ isAdmin() ? 'true' : 'false' }};
        if(_adminPass == 'Y' && _isAdmin === false ){
            alert("현재 접근 불가능합니다.");
            window.location.href = "{{ route('support.info',['work_code'=>$work_code]) }}";
        }

        //등록기간 체크
        const _dueCheck = {{ $isSupportDue ? 'true' : 'false' }};
        if(_dueCheck === false){
            console.log('hi');
            alert("현재 후원신청 기간이 아닙니다.");
            window.location.href = "{{ route('support.info',['work_code'=>$work_code]) }}";
        }

        //캡챠
        $(document).on('keyup', '#captcha_input', function() {
            const _captcha_input = $(this).val();
            callNoneSpinnerAjax(dataUrl, {
                'case': 'captcha-compare',
                'captcha_input': _captcha_input,
            });
        });

        const boardSubmit = () => {

            if (isEmpty($("#captcha_input").val())) {
                alert("자동화 프로그램 입력 방지 코드를 입력 해주세요.");
                $("#captcha_input").focus();
                return false;
            }

            if( $("#captcha_input").data('chk') == 'N' ){
                alert("자동화 프로그램 입력 방지 코드를 확인 해주세요.");
                $("#captcha_input").focus();
                return false;
            }

            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('support-script')
@endsection
