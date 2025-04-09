<div class="sub-tit-wrap">
    <h4 class="sub-tit">회사 기본 정보</h4>
</div>
<p class="help-text mb-10">※ 필수 입력 항목은 빨간색 (<span class="required">*</span>)이 표시되어 있습니다.</p>
<div class="write-wrap">
    <ul>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 회사명</div>
            <div class="form-con">
                <input type="text" class="form-item" name="company" id="company" value="{{ $sup->company ?? '' }}">
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 대표자명</div>
            <div class="form-con">
                <input type="text" class="form-item" name="ceo" id="ceo" value="{{ $sup->ceo ?? '' }}">
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 사업장 주소</div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" class="form-item" name="company_zipcode" id="company_zipcode" value="{{ $sup->company_zipcode ?? '' }}" onlyNumber readonly>
                    <a href="javascript:;" class="btn btn-small color-type7 post-code" data-target="company_">우편번호 찾기</a>
                </div>
                <div class="form-group n2 mt-10">
                    <input type="text" class="form-item" name="company_address" id="company_address" value="{{ $sup->company_address ?? '' }}" readonly>
                    <input type="text" class="form-item" name="company_address2" id="company_address2" value="{{ $sup->company_address2 ?? '' }}">
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="sub-tit-wrap">
    <h4 class="sub-tit">담당자 정보</h4>
</div>
<div class="write-wrap">
    <ul>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 담당자명</div>
            <div class="form-con">
                <input type="text" class="form-item" name="manager" id="manager" value="{{ $sup->manager ?? '' }}">
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 직급</div>
            <div class="form-con">
                <input type="text" class="form-item" name="position" id="position" value="{{ $sup->position ?? '' }}">
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 소속 부서</div>
            <div class="form-con">
                <input type="text" class="form-item" name="department" id="department" value="{{ $sup->department ?? '' }}">
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 우편물 수령지</div>
            <div class="form-con">
                <div class="form-group has-btn">
                    <input type="text" class="form-item" name="manager_zipcode" id="manager_zipcode" value="{{ $sup->manager_zipcode ?? '' }}" onlyNumber readonly>
                    <a href="javascript:;" class="btn btn-small color-type7 post-code" data-target="manager_">우편번호 찾기</a>
                </div>
                <div class="form-group n2 mt-10">
                    <input type="text" class="form-item" name="manager_address" id="manager_address" value="{{ $sup->manager_address ?? '' }}" readonly>
                    <input type="text" class="form-item" name="manager_address2" id="manager_address2" value="{{ $sup->manager_address2 ?? '' }}">
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 전화</div>
            <?php
            if( !empty($sup->tel) ){
                $tel = explode('-', $sup->tel);
            }
            ?>
            <div class="form-con">
                <div class="form-group-text">
                    <input type="text" class="form-item" name="tel[]" id="tel1" value="{{ $tel[0] ?? '' }}" maxlength="3" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="tel[]" id="tel2" value="{{ $tel[1] ?? '' }}" maxlength="4" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="tel[]" id="tel3" value="{{ $tel[2] ?? '' }}" maxlength="4" onlyNumber>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 담당자 핸드폰</div>
            <?php
            if( !empty($sup->phone) ){
                $phone = explode('-', $sup->phone);
            }
            ?>
            <div class="form-con">
                <div class="form-group-text">
                    <input type="text" class="form-item" name="phone[]" id="phone1" value="{{ $phone[0] ?? '' }}" maxlength="3" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="phone[]" id="phone2" value="{{ $phone[1] ?? '' }}" maxlength="4" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="phone[]" id="phone3" value="{{ $phone[2] ?? '' }}" maxlength="4" onlyNumber>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit">FAX</div>
            <?php
            if( !empty($sup->fax) ){
                $fax = explode('-', $sup->fax);
            }
            ?>
            <div class="form-con">
                <div class="form-group-text">
                    <input type="text" class="form-item" name="fax[]" id="fax1" value="{{ $fax[0] ?? '' }}" maxlength="3" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="fax[]" id="fax2" value="{{ $fax[1] ?? '' }}" maxlength="4" onlyNumber>
                    <span class="text">-</span>
                    <input type="text" class="form-item" name="fax[]" id="fax3" value="{{ $fax[2] ?? '' }}" maxlength="4" onlyNumber>
                </div>
            </div>
        </li>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 담당자 E-MAIL</div>
            <div class="form-con">
                <input type="text" class="form-item emailOnly" name="email" id="email" value="{{ $sup->email ?? '' }}" >
            </div>
        </li>
    </ul>
</div>

<div class="sub-tit-wrap">
    <h4 class="sub-tit">후원 구분</h4>
</div>
<div class="write-wrap">
    <ul>
        <li>
            <div class="form-tit"><strong class="required">*</strong> 구분</div>
            <div class="form-con">
                <div class="radio-wrap cst">
                    @foreach( $workshopConfig['grade'] as $key => $val )
                        <label class="radio-group w-100p" for="grade{{ $key }}">
                            <input type="radio" name="grade" id="grade{{ $key }}" value="{{ $key }}" {{ ( $sup->grade ?? '' ) == $key ? 'checked' : ''  }} data-price="{{ $val['price'] }}">{{ $val['name'] }} - {{ number_format($val['price']) }}원 (VAT없음)
                        </label>
                    @endforeach
                </div>
            </div>
        </li>
    </ul>
</div>

@section('support-script')
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    $(document).on('click', '.post-code', function() {
        callPostCode($(this).data('target'));
    });

    $(document).on('click', 'input[name=grade]', function() {
        $("#price").val($(this).data('price'));
    });

    $(document).on('click','#post', function(){
        if (isEmpty($("#company").val())) {
            alert('회사명을 입력해주세요.');
            $("#company").focus();
            return false;
        }
        if (isEmpty($("#ceo").val())) {
            alert('대표자명을 입력해주세요.');
            $("#ceo").focus();
            return false;
        }
        if (isEmpty($("#company_zipcode").val())) {
            alert('사업자 주소를 입력해주세요.');
            $("#company_zipcode").focus();
            return false;
        }
        if (isEmpty($("#company_address").val())) {
            alert('사업자 주소를 입력해주세요.');
            $("#company_address").focus();
            return false;
        }
        if (isEmpty($("#company_address2").val())) {
            alert('사업자 주소를 입력해주세요.');
            $("#company_address2").focus();
            return false;
        }

        if (isEmpty($("#manager").val())) {
            alert('담당자명을 입력해주세요.');
            $("#manager").focus();
            return false;
        }
        if (isEmpty($("#position").val())) {
            alert('직급을 입력해주세요.');
            $("#position").focus();
            return false;
        }
        if (isEmpty($("#department").val())) {
            alert('소속 부서를 입력해주세요.');
            $("#department").focus();
            return false;
        }
        if (isEmpty($("#manager_zipcode").val())) {
            alert('우편물 수령지를 입력해주세요.');
            $("#manager_zipcode").focus();
            return false;
        }
        if (isEmpty($("#manager_address").val())) {
            alert('우편물 수령지를 입력해주세요.');
            $("#manager_address").focus();
            return false;
        }
        if (isEmpty($("#manager_address2").val())) {
            alert('우편물 수령지를 입력해주세요.');
            $("#manager_address2").focus();
            return false;
        }

        let telCheck = false;
        $("input[name='tel[]']").each(function(index, item) {
            if (isEmpty($(item).val())) {
                telCheck = true;
                return false;
            }
        });
        if (telCheck) {
            alert('전화번호를 입력해주세요.');
            $("input[name='tel[]']").focus();
            return false;
        }

        let phoneCheck = false;
        $("input[name='phone[]']").each(function(index, item) {
            if (isEmpty($(item).val())) {
                phoneCheck = true;
                return false;
            }
        });
        if (phoneCheck) {
            alert('담당자 핸드폰 번호를 입력해주세요.');
            $("input[name='phone[]']").focus();
            return false;
        }

        if (isEmpty($("#email").val())) {
            alert('담당자 E-MAIL을 입력해주세요.');
            $("#email").focus();
            return false;
        }
        if ( $("input[name='grade']:checked").length < 1) {
            alert('구분을 선택해주세요.');
            $("input[name='grade']").focus();
            return false;
        }

        boardSubmit();
    });
</script>
@endsection
