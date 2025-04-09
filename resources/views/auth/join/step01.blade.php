@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <!-- s:약관동의 -->
            <p class="signup-text text-center">
                대한환경공학회는 회원님의 개인정보보호를 위해 최선을 다하고 있습니다.<br>
                <span class="highlights green text-green">회원님의 정보는 동의 없이 공개되지 않으며, 개인정보취급방침 가이드에 맞춰 보호 받고 있습니다.</span>
            </p>
            
            <div class="step-list-wrap">
                <ul class="step-list">
                    <li class="on">Step 1. 약관동의</li>
                    <li>Step 2. 정보입력</li>
                    <li>Step 3. 가입완료</li>
                </ul>
            </div>

            <form id="register-frm" action="" method="post" onsubmit="" data-sid="{{ !empty($sid) ? $sid : '' }}" data-case="register-step1">
                <input type="hidden" name="gubun" value="{{ request()->gubun ?? '' }}" readonly>
                <input type="hidden" name="step" value="{{ request()->step ?? '' }}" readonly>

                <fieldset>
                    <legend class="hide">약관동의</legend>
                    <div class="sub-tit-wrap mt-0">
                        <h3 class="sub-tit">이용약관</h3>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            대한환경공학회 회원은 정회원과 특별회원으로 구분하고 있습니다.
                            <br><br>
                            <strong>■ 정회원</strong><br><br>
                            <ul class="list-type list-type-decimal">
                                <li>가입혜택
                                    <ul class="list-type list-type-bar">
                                        <li>학회에 가입하실 경우 월간 「대한환경공학회지」, 격월로 발행하는 영문학회지「Environmental Engineering Research」 총 18권의 학회지 구독</li>
                                        <li>국문지 논문투고 가능</li>
                                        <li>춘/추계학술대회 참석시 정회원의 경우 참가비 할인혜택</li>
                                    </ul>
                                </li>
                                <li>회원가입
                                    <ul class="list-type list-type-bar">
                                        <li>가입비 20,000원과 연회비 50,000원 (합계 70,000)을 납입하여 주시면 됩니다.</li>
                                        <li>매년 연회비 50,000원을 회비납부 내역에서 납입하여 주시거나, 학회 계좌(우리은행 189-04-120560)로 입금하여주시기 바랍니다.</li>
                                    </ul>
                                </li>
                            </ul>
                            <br><br>
                            <strong>■ 특별회원</strong><br><br>
                            <ul class="list-type list-type-decimal">
                                <li>구분
                                    <ul class="list-type list-type-bar">
                                        <li>중소기업, 국가기관, 정부투자기관, 공기업, 대기업</li>
                                    </ul>
                                </li>
                                <li>회비
                                    <ul class="list-type list-type-bar">
                                        <li>중소기업 : 50만원</li>
                                        <li>국가기관, 공기업 : 100만원</li>
                                        <li>대기업 : 150만원</li>
                                        <li>기타 : 회원사 규정이 별도로 있는 경우, 이사회의 승인 하에 금액을 결정한다</li>
                                    </ul>
                                </li>
                                <li>가입혜택
                                    <ul class="list-type list-type-bar">
                                        <li>국·영문학회지 배부(필요수량만큼 추가 배부)</li>
                                        <li>학술대회 참가 시 회원사 직원 5인까지 등록비 면제, 6인부터 참가비 할인(회비에 따라 다름)</li>
                                        <li>학술대회 논문발표 시 논문발표자의 신입회비 면제</li>
                                        <li>대기업의 경우 학회지에 광고를 연1회 보너스 게재</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sub-tit-wrap">
                        <h3 class="sub-tit">개인정보 수집 및 이용에 대한 안내</h3>
                    </div>
                    <div class="term-wrap scroll-y">
                        <div class="term-conbox">
                            <strong>■ 개인정보의 수집 및 이용목적</strong><br><br>
                            대한환경공학회가 회원님 개인의 정보를 수집하는 목적은 대한환경공학회사이트를 통하여 학회 회원들을 위한 회원 관리, 메일 발송 등 최적의 맞춤화된 
                            서비스를 제공하고, 학회 업무의 원활한 진행을 위한 것입니다. 대한환경공학회는 각종의 학회 컨텐츠를 서비스해 드리고 있습니다. 이때 회원님께서 
                            제공해주신 개인정보를 바탕으로 회원님께 보다 더 유용한 정보를 선택적으로 제공하는 것이 가능하게 됩니다.
                            <br><br>
                            <strong>■ 수집하는 개인정보의 항목</strong><br><br>
                            대한환경공학회는 회원 가입 시 개인정보를 요구하고 있습니다. 회원님의 이름, 아이디, 비밀번호, 성명(한글/한자/영문), 생년월일 , E-mail, E-mail 
                            수신여부, 우편물 수령지, 직장명, 부서, 직종, 직장 주소, 직장 전화번호, Fax, 자택주소, 자택전화번호, 휴대폰 번호, 학위, 졸업(예정)년, 취득국가, 
                            취득기관, 학과, 지도교수, 국눙 논문명, 영문 논문명, 관심 전문위원회, 연구핵심어 등을 입력사항으로 수집하고 있습니다.
                            <br><br>
                            <strong>■ 개인정보의 보유 및 이용기간</strong><br><br>
                            회원님이 대한환경공학회가 제공하는 서비스를 받는 동안 회원님의 개인정보는 대한환경공학회에서 계속 보유하며 서비스 제공을 위해 이용하게 됩니다. 
                            회원님이 탈퇴를 요청할 경우 탈퇴요청과 동시에 가입 시 기재한 개인정보가 삭제됩니다.                            
                        </div>
                    </div>
                    <div class="checkbox-wrap cst">
                        <label class="checkbox-group">
                            <input type="checkbox" name="agree" id="agree" value="Y">대한환경공학회 회원가입 약관에 동의합니다.
                        </label>
                    </div>        
                </fieldset>
            </form>
            <div class="btn-wrap text-center">
                <a href="javascript:;" onclick="$('#register-frm').submit();" class="btn btn-type2 color-type6"><img src="/assets/image/sub/ic_btn_check.png" alt="" class="ic-chk"> 회원가입</a>
            </div>
            <!-- //e:약관동의 -->
        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';

        defaultVaildation();

        $(form).validate({

            rules: {
                agree: {
                    checkEmpty: true,
                },
            },
            messages: {
                agree: {
                    checkEmpty: '회원가입 약관에 동의해주세요.',
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