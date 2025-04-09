@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
    <style>
        .cst input[type="checkbox"] {
            appearance: none;
            position: relative;
            width: 16px;
            height: 16px;
            margin-top: -5px;
            margin-right: 5px;
            border: 2px solid #bfbfbf;
            transition: 0.3s ease;
            cursor: pointer;
            vertical-align: middle;
        }
        .cst input[type="checkbox"] {
            border-radius: 3px;
            border-color: #bfbfbf;
            background-position: center;
        }
        
        .cst input[type="checkbox"]:checked::before {
            content: '';
            position: absolute;
            top: 0;
            left: 25%;
            display: block;
            height: 70%;
            width: 30%;
            transform: rotate(50deg);
            border-right: 2px solid #0096da;
            border-bottom: 2px solid #0096da;
        }

        .cst input[type="checkbox"]:checked {
            border-color: #0096da;
        }
    </style>
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
                        <li class="on"><a href="{{ route('abstract.check',['work_code'=>$work_code]) }}"><span>YEP 초록접수</span></a></li>
                        <li><a href="{{ route('abstract.search',['work_code'=>$work_code]) }}"><span>YEP 초록접수 조회 및 수정</span></a></li>
                    </ul>
                </div>

                <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($abs->sid) ? $abs->sid : '' }}" data-case="abstract-{{ !empty($abs->sid) ? 'update':'create' }}">
                    <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
                    <input type="hidden" name="reg_sid" value="{{ request()->reg_sid ?? '' }}" readonly>

                    <legend class="hide">초록접수 작성</legend>
                    <div class="write-tit-wrap bg-green">
                        <img src="/target/202501/assets/image/sub/ic_abstract_write.png" alt="">
                        <div class="text-wrap">
                            <p class="tit">{{ $workshop->subject ?? '' }} 초록 등록</p>
                            <p class="des">초록접수 마감일 : {!! $endDate ?? '' !!}</p>
                        </div>
                    </div>

                    @include('workshop.'.$work_code.'.'.'abstract.form.regist-frm')

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
                        <a href="javascript:;" class="btn btn-type1 color-type4 btn-line" id="post">{{ !empty($abs->sid) && ($abs->status ?? '') == 'Y' ? '수정하기' : '미리보기' }}</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
                    </div>

                </form>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('abstract.data',['work_code'=>$work_code]) }}';

        //adminPass 체크 - 일반 사용자는 사용X
        const _adminPass = '{{ $workshop->adminPass }}';
        const _isAdmin = {{ isAdmin() ? 'true' : 'false' }};
        if(_adminPass == 'Y' && _isAdmin === false ){
            alert("현재 접근 불가능합니다.");
            window.location.href = "{{ route('abstract.info',['work_code'=>$work_code]) }}";
        }

        //등록기간 체크
        const _dueCheck = {{ $isAbsDue ? 'true' : 'false' }};
        if(_dueCheck === false){
            console.log('hi');
            alert("현재 초록등록 기간이 아닙니다.");
            window.location.href = "{{ route('abstract.info',['work_code'=>$work_code]) }}";
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
            ajaxData.append('contents', tinymce.get('contents').getContent());
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('abs-script')
@endsection
