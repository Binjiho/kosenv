@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
    <link type="text/css" rel="stylesheet" href="/assets/css/slick.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/common.css">
    <link type="text/css" rel="stylesheet" href="/assets/css/jquery-ui.min.css">
@endsection

@section('contents')
    <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($workshop->sid) ? $workshop->sid : '' }}" data-case="workshop-{{ !empty($workshop->sid) ? 'update' : 'create' }}">
        <input type="hidden" name="gubun" value="{{ $workshop->gubun ?? '' }}" readonly>

        <fieldset>
            <legend class="hide">학술대회 정보 입력</legend>

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">학술대회 정보 입력</h3>
            </div>
            <ul class="write-wrap">
                <li>
                    <div class="form-tit">
                        코드
                    </div>
                    <div class="form-con">
                        <input type="text" name="work_code" id="work_code" value="{{ $workshop->work_code ?? '' }}" class="form-item w-40p " onlyNumber>
                        (접수번호를 생성할때 사용되오니 참고해주세요)
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        행사명
                    </div>
                    <div class="form-con">
                        <input type="text" name="subject" id="subject" value="{{ $workshop->subject ?? '' }}" class="form-item ">
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        행사일
                    </div>
                    <div class="form-con">
                        <input type="text" name="event_sdate" id="event_sdate" value="{{ $workshop->event_sdate ?? '' }}" class="form-item w-40p" datetimepicker> ~
                        <input type="text" name="event_edate" id="event_edate" value="{{ $workshop->event_edate ?? '' }}" class="form-item w-40p" datetimepicker>
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        장소
                    </div>
                    <div class="form-con">
                        <input type="text" name="place" id="place" value="{{ $workshop->place ?? '' }}" class="form-item " >
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        사전등록 기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="regist_sdate" id="regist_sdate" value="{{ $workshop->regist_sdate ?? '' }}" class="form-item w-40p" datetimepicker> ~
                        <input type="text" name="regist_edate" id="regist_edate" value="{{ $workshop->regist_edate ?? '' }}" class="form-item w-40p" datetimepicker>
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        사전등록 유예기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="regist_grace_sdate" id="regist_grace_sdate" value="{{ $workshop->regist_grace_sdate ?? '' }}" class="form-item w-40p " datetimepicker {{ ($workshop->regist_grace_yn ?? '') == 'Y' ? '' : 'disabled' }}> ~
                        <input type="text" name="regist_grace_edate" id="regist_grace_edate" value="{{ $workshop->regist_grace_edate ?? '' }}" class="form-item w-40p " datetimepicker {{ ($workshop->regist_grace_yn ?? '') == 'Y' ? '' : 'disabled' }}>

                        <div class="checkbox-wrap cst">
                            <label for="regist_grace_yn_1" class="checkbox-group">
                                <input type="checkbox" name="regist_grace_yn" id="regist_grace_yn_1" value="Y" {{ ($workshop->regist_grace_yn ?? '') == 'Y' ? 'checked' : '' }}>
                                체크 시 결제 상태 > 미입금 상태인 등록자만 등록 가능한 날짜 선택 항목 활성화 (입금완료 사용자 or 신규 등록 불가)
                            </label>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        초록접수 기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="abs_sdate" id="abs_sdate" value="{{ $workshop->abs_sdate ?? '' }}" class="form-item w-40p" datetimepicker> ~
                        <input type="text" name="abs_edate" id="abs_edate" value="{{ $workshop->abs_edate ?? '' }}" class="form-item w-40p" datetimepicker>
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        초록접수 유예기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="abs_grace_sdate" id="abs_grace_sdate" value="{{ $workshop->abs_grace_sdate ?? '' }}" class="form-item w-40p " datetimepicker {{ ($workshop->abs_grace_yn ?? '') == 'Y' ? '' : 'disabled' }}> ~
                        <input type="text" name="abs_grace_edate" id="abs_grace_edate" value="{{ $workshop->abs_grace_edate ?? '' }}" class="form-item w-40p " datetimepicker {{ ($workshop->abs_grace_yn ?? '') == 'Y' ? '' : 'disabled' }}>

                        <div class="checkbox-wrap cst">
                            <label for="abs_grace_yn_1" class="checkbox-group">
                                <input type="checkbox" name="abs_grace_yn" id="abs_grace_yn_1" value="Y" {{ ($workshop->abs_grace_yn ?? '') == 'Y' ? 'checked' : '' }}>
                                체크 시 제출 상태 > 입력진행 중 상태인 수정 가능한 날짜 선택항목 활성화 (최종 체출 사용자 or 신규 제출 불가)
                            </label>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="form-tit">
                        후원신청 기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="support_sdate" id="support_sdate" value="{{ $workshop->support_sdate ?? '' }}" class="form-item w-40p" datetimepicker> ~
                        <input type="text" name="support_edate" id="support_edate" value="{{ $workshop->support_edate ?? '' }}" class="form-item w-40p" datetimepicker>
                    </div>
                </li>
                <li>
                    <div class="form-tit">
                        전시신청 기간
                    </div>
                    <div class="form-con">
                        <input type="text" name="display_sdate" id="display_sdate" value="{{ $workshop->display_sdate ?? '' }}" class="form-item w-40p" datetimepicker> ~
                        <input type="text" name="display_edate" id="display_edate" value="{{ $workshop->display_edate ?? '' }}" class="form-item w-40p" datetimepicker>
                    </div>
                </li>

                <li>
                    <div class="form-tit">등록페이지 접근 권한</div>
                    <div class="form-con">
                        <div class="checkbox-wrap cst">
                            <label for="hide_1" class="checkbox-group">
                                <input type="checkbox" name="adminPass" id="adminPass_1" value="Y" {{ ($workshop->adminPass ?? '') == 'Y' ? 'checked' : '' }}>
                                * 체크 시 접수기간과 상관없이 일반 사용자 접근 불가합니다. (관리자만 접근 가능)
                            </label>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="btn-wrap text-center">
                <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
                <button type="submit" class="btn btn-type1 color-type6">{{ !empty($workshop->sid) ? '수정' : '등록' }}</button>
            </div>

        </fieldset>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('workshop.data') }}';

        $(document).on('click','#regist_grace_yn_1', function(){
           if($("#regist_grace_yn_1").is(':checked')){
               $("#regist_grace_sdate").prop('disabled', false);
               $("#regist_grace_sdate").next('.form-control').prop('disabled', false);
               $("#regist_grace_edate").prop('disabled', false);
               $("#regist_grace_edate").next('.form-control').prop('disabled', false);
           }else{
               $("#regist_grace_sdate").prop('disabled', true).val('');
               $("#regist_grace_sdate").next('.form-control').prop('disabled', true).val('');

               $("#regist_grace_edate").prop('disabled', true).val('');
               $("#regist_grace_edate").next('.form-control').prop('disabled', true).val('');
           }
        });

        $(document).on('click','#abs_grace_yn_1', function(){
            if($("#abs_grace_yn_1").is(':checked')){
                $("#abs_grace_sdate").prop('disabled', false);
                $("#abs_grace_sdate").next('.form-control').prop('disabled', false);
                $("#abs_grace_edate").prop('disabled', false);
                $("#abs_grace_edate").next('.form-control').prop('disabled', false);
            }else{
                $("#abs_grace_sdate").prop('disabled', true).val('');
                $("#abs_grace_sdate").next('.form-control').prop('disabled', true).val('');

                $("#abs_grace_edate").prop('disabled', true).val('');
                $("#abs_grace_edate").next('.form-control').prop('disabled', true).val('');
            }
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                work_code: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                event_sdate: {
                    isEmpty: true,
                },
                event_edate: {
                    isEmpty: true,
                },
                place: {
                    isEmpty: true,
                },
                regist_sdate: {
                    isEmpty: true,
                },
                regist_edate: {
                    isEmpty: true,
                },
                regist_grace_sdate: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='regist_grace_yn']").is(":checked");
                        }
                    },
                },
                regist_grace_edate: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='regist_grace_yn']").is(":checked");
                        }
                    },
                },
                abs_sdate: {
                    isEmpty: true,
                },
                abs_edate: {
                    isEmpty: true,
                },
                abs_grace_sdate: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='abs_grace_yn']").is(":checked");
                        }
                    },
                },
                abs_grace_edate: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='abs_grace_yn']").is(":checked");
                        }
                    },
                },
            },
            messages: {
                work_code: {
                    isEmpty: '코드를 입력해주세요.',
                },
                subject: {
                    isEmpty: '행사명을 입력해주세요.',
                },
                event_sdate: {
                    isEmpty: '행사일 시작날짜를 입력해주세요.',
                },
                event_edate: {
                    isEmpty: '행사일 종료날짜를 입력해주세요.',
                },
                place: {
                    isEmpty: '장소를 입력해주세요.',
                },
                regist_sdate: {
                    isEmpty: '사전등록 시작날짜를 입력해주세요.',
                },
                regist_edate: {
                    isEmpty: '사전등록 마감날짜를 입력해주세요.',
                },
                regist_grace_sdate: {
                    isEmpty: '사전등록 유예기간 시작날짜를 입력해주세요.',
                },
                regist_grace_edate: {
                    isEmpty: '사전등록 유예기간 마감날짜를 입력해주세요.',
                },
                abs_sdate: {
                    isEmpty: '초록접수 시작날짜를 입력해주세요.',
                },
                abs_edate: {
                    isEmpty: '초록접수 마감날짜를 입력해주세요.',
                },
                abs_grace_sdate: {
                    isEmpty: '초록등록 유예기간 시작날짜를 입력해주세요.',
                },
                abs_grace_edate: {
                    isEmpty: '초록등록 유예기간 마감날짜를 입력해주세요.',
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
