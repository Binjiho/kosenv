<fieldset>
    <div class="sub-tit-wrap">
        <h4 class="sub-tit">접수자 정보</h4>
    </div>
    <div class="table-wrap">
        <table class="cst-table">
            <caption class="hide">접수자 정보</caption>
            <colgroup>
                <col style="width:25%;">
                <col style="width:25%;">
                <col style="width:25%;">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th>참가구분</th>
                <td colspan="3" class="text-left">전문가그룹세션 발표자</td>
            </tr>
            <tr>
                <th>대한환경공학회 홈페이지 회원여부</th>
                <td class="text-left">{{ $workshopConfig['user_chk'][$reg->user_chk] ?? '' }}</td>
                <th>국적</th>
                <td class="text-left">{{ $reg_country->cn ?? ''}} </td>
            </tr>
            <tr>
                <th>성명</th>
                <td class="text-left">{{ $reg->name_kr ?? '' }}</td>
                <th>직장명 (소속)</th>
                <td class="text-left">{{ $reg->sosok_kr ?? '' }}</td>
            </tr>
            <tr>
                <th>직위</th>
                <td class="text-left">{{ $reg->position ?? '' }}</td>
                <th>이메일</th>
                <td class="text-left">{{ $reg->email ?? '' }}</td>
            </tr>
            <tr>
                <th>휴대폰번호</th>
                <td class="text-left">{{ $reg->phone ?? '' }}</td>
                <th></th>
                <td class="text-left"></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-tit-wrap">
        <h4 class="sub-tit">초록 정보</h4>
    </div>
    <p class="help-text mb-10">※ 필수 입력 항목은 빨간색 (<span class="required">*</span>)이 표시되어 있습니다.</p>
    <div class="write-wrap">
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 대주제</div>
                <div class="form-con">
                    <select name="topic" id="topic" class="form-item">
                        <option value="">대주제 선택</option>
                        @foreach($workshopConfig['topic'] as $key => $val)
                        <option value="{{ $key }}" {{ ($abs->topic ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 논문 제목 (국문)</div>
                <div class="form-con">
                    <input type="text" name="title_kr" id="title_kr" value="{{ $abs->title_kr ?? '' }}" class="form-item" noneEn>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 논문 제목 (영문)</div>
                <div class="form-con">
                    <input type="text" name="title_en" id="title_en" value="{{ $abs->title_en ?? '' }}" class="form-item" noneKo>
                </div>
            </li>
        </ul>
        <div class="write-wrap-top text-right">
            <div class="cnt-num">
                글자수 : <input type="text" id="max_words" name="contents_words" value="{{ $abs->contents_words ?? 0 }}" class="form-item" data-url="{{ checkUrl() }}"> / 350 단어 (공백제외)
            </div>
        </div>
        <ul>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 초록 (Abstract)</div>
                <div class="form-con">
                    <input type="hidden" value="0" class="tinyword-cnt">
                    <textarea name="contents" id="contents" class="form-item tinymce">{!! $abs->contents ?? '' !!}</textarea>
                </div>
            </li>
            <li>
                <div class="form-tit"><strong class="required">*</strong> 주제어 (Keywords)</div>
                <div class="form-con">
                    <div class="form-group n5">
                        <input type="text" name="keyword1" id="keyword1" value="{{ $abs->keyword1 ?? '' }}" class="form-item">
                        <input type="text" name="keyword2" id="keyword2" value="{{ $abs->keyword2 ?? '' }}" class="form-item">
                        <input type="text" name="keyword3" id="keyword3" value="{{ $abs->keyword3 ?? '' }}" class="form-item">
                        <input type="text" name="keyword4" id="keyword4" value="{{ $abs->keyword4 ?? '' }}" class="form-item">
                        <input type="text" name="keyword5" id="keyword5" value="{{ $abs->keyword5 ?? '' }}" class="form-item">
                    </div>
                </div>
            </li>
            <li>
                <div class="form-tit">사사 (Acknowledgment)</div>
                <div class="form-con">
                    <div class="form-group">
                        <input type="text" name="ack" id="ack" value="{{ $abs->ack ?? '' }}" class="form-item">
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="sub-tit-wrap">
        <h4 class="sub-tit">저자 정보</h4>
    </div>

    <div class="write-wrap n-bd">
        <div class="write-wrap-top">
            <div class="btn-wrap mt-0">
                <a href="javascript:addAffiliation()" class="btn btn-small color-wh btn-line">+&nbsp;&nbsp;&nbsp;기관 및 소속 추가</a>
            </div>
            <p class="tit">기관 및 소속 정보</p>
        </div>

        <div class="table-wrap n-bd-t mt-0">
            <table class="cst-table">
                <caption class="hide">기관 및 소속 정보</caption>
                <colgroup>
                    <col style="width:80px;">
                    <col>
                    <col style="width:150px;">
                </colgroup>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>소속 및 기관 명</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody >
                    @include('workshop.'.$work_code.'.'.'abstract.include.affiliation')
                </tbody>
            </table>
        </div>

        <div class="write-wrap-top mt-20">
            <div class="btn-wrap mt-0">
                <a href="javascript:addAuthor()" class="btn btn-small color-wh btn-line">+&nbsp;&nbsp;&nbsp;저자 추가</a>
            </div>
            <p class="tit">저자</p>
        </div>

        <div class="table-wrap n-bd-t mt-0 ">
            <table class="cst-table">
                <caption class="hide">저자 추가</caption>
                <colgroup>
                    <col style="width:80px;">
                    <col>
                    <col style="width:20%;">
                    <col style="width:90px;">
                    <col style="width:150px;">
                </colgroup>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>이름</th>
                    <th>기관 및 소속</th>
                    <th>교신저자</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                @include('workshop.'.$work_code.'.'.'abstract.include.author')
                </tbody>
            </table>
        </div>

    </div>

</fieldset>

@section('abs-script')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/app/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
    <script>
        const maxAddCnt = {{ $maxAddCnt }};

        const addAffiliation = () => {
            const target = $('.target-affiliation');
            const length = target.length;

            if (length < maxAddCnt) {
                // 체크박스
                $('.target-author').each(function (key, author) {
                    $(author).find('.checkbox-group').each(function (index, item) {
                        (index < (length + 1))
                            ? $(item).show()
                            : $(item).hide();
                    });
                });

                callAjax(dataUrl, {
                    'case': 'add-affiliation',
                    'eq': (length + 1),
                });
            }
        }

        const addAuthor = () => {
            const target = $('.target-author').not( '.presenter' );
            const length = target.length;

            if (length < maxAddCnt) {
                callAjax(dataUrl, {
                    'case': 'add-author',
                    'eq': ($('.target-author').length + 1),
                    'affiliations_count': $('.target-affiliation').length,
                });
            }
        }

        //순서 변경
        function move_order(el,mode){
            const _target = $(el).closest("tr");
            if (mode === "down") {
                const _next = _target.next();
                if (_next.length) {
                    _target.insertAfter(_next);
                }
            } else {
                const _prev = _target.prev();
                if (_prev.length) {
                    _target.insertBefore(_prev);
                }
            }

            $('.affiliation-eq').each(function(index, item) {
                const eq = (index + 1);
                $(item).html(eq);
            });

            $('.author-eq').each(function(index, item) {
                const eq = (index + 1);
                $(item).html(eq);
            });
        }

        $(document).on('click', '.affiliation-delete', function() {
            const deleteIndex = $('.affiliation-delete').index(this) + 1; // Affiliation 1은 delete 버튼없어서 +1

            $(this).closest('tr').remove();

            $('.affiliation-eq').each(function(index, item) {
                const eq = (index + 1);
                $(item).html(eq);
            });

            // affiliation 삭제시 author 체크박스 체크상태 변경
            $('.target-author').each(function(key, author) {
                const $author = $(author);
                const $affiliationCheckboxes = $author.find('.affiliation-checkbox');

                $affiliationCheckboxes.each(function(eq) {
                    const $currentCheckbox = $(this).find('input[type=checkbox]');
                    const $nextCheckbox = $affiliationCheckboxes.eq(eq + 1).find('input[type=checkbox]');

                    if (eq >= deleteIndex) {
                        $currentCheckbox.prop('checked', false);

                        if ($nextCheckbox.prop('checked')) {
                            $currentCheckbox.prop('checked', true);
                        }
                    }

                });
            });

            authorListChange();
        });

        $(document).on('click', '.author-delete', function() {
            $(this).closest('tr').remove();

            $('.author-eq').each(function(index, item) {
                const eq = (index + 1);
                $(item).html(eq);
            });

        });

        const authorListChange = () => {
            const target = $('.target-author');

            target.each(function(key, author) {
                const eq = (key + 1);

                // No 변경
                $(author).find('.author-eq').html(eq);

                // Order Display 변경
                (key == 0)
                    ? $(author).find('.btn-arrow.up').hide()
                    : $(author).find('.btn-arrow.up').show();


                // Corresponding Author 라디오 버튼 수정
                $(author).find('input[name=c_author_yn]').val(eq);
                $(author).find('input[name=c_author_yn]').attr('id', 'c_author_yn_' + eq);
                $(author).find('.radio-group label').attr('for', 'c_author_yn_' + eq);

                // Affiliation  체크박스 수정
                $(author).find('.affiliation-checkbox').each(function(i, checkbox) {
                    const checkbox_name = ('affiliation_check_' + eq + '[]');
                    const checkbox_id = ('affiliation_check_' + eq + '_' + (i + 1));

                    $(checkbox).find('input[type=checkbox]').attr('name', checkbox_name);
                    $(checkbox).find('input[type=checkbox]').attr('id', checkbox_id);
                    $(checkbox).find('label').attr('for', checkbox_id);

                    if (i < $('.target-affiliation').length) {
                        $(checkbox).show();
                    } else {
                        $(checkbox).hide();
                        $(checkbox).find('input[type=checkbox]').prop('checked', false);
                    }
                });
            });
        }

        const tinyEmptyCheck = (target) => {
            let tinymceVal = tinymce.get(target).getContent(); // 내용 가져오기
            tinymceVal = tinymceVal.replace(/<[^>]*>?/g, ""); // html 태그 삭제
            tinymceVal = tinymceVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

            return isEmpty(tinymceVal);
        }

        $(document).on('click','#post', function(){
            if (isEmpty($("select[name='topic']").val())) {
                alert('대주제를 선택해주세요.');
                $("select[name='topic']").focus();
                return false;
            }

            if (isEmpty($("#title_kr").val())) {
                alert('논문 제목 (국문)을 입력해주세요.');
                $("#title_kr").focus();
                return false;
            }
            if (isEmpty($("#title_en").val())) {
                alert('논문 제목 (영문)을 입력해주세요.');
                $("#title_en").focus();
                return false;
            }

            if (tinyEmptyCheck('contents')) {
                alert('초록(Abstract)를 입력해주세요.');
                $("textarea[name='contents']").focus();
                return false;
            }

            let keywordCheck = true;
            $("input[name^='keyword']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    keywordCheck = false;
                } else {
                    keywordCheck = true;
                    return false;
                }
            });

            if (!keywordCheck) {
                alert('주제어 1개 입력은 필수 입니다.');
                $("input[name='keyword1']").focus();
                return false;
            }

            let affi_krCheck = true;
            $("input[name='affi_kr[]']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    affi_krCheck = false;
                } else {
                    affi_krCheck = true;
                    return false;
                }
            });

            if (!affi_krCheck) {
                alert('기관 및 소속 국문명을 입력해주세요.');
                $("input[name='affi_kr[]']").focus();
                return false;
            }

            let affi_enCheck = true;
            $("input[name='affi_en[]']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    affi_enCheck = false;
                } else {
                    affi_enCheck = true;
                    return false;
                }
            });

            if (!affi_enCheck) {
                alert('기관 및 소속 영문명을 입력해주세요.');
                $("input[name='affi_en[]']").focus();
                return false;
            }

            let name_krCheck = true;
            $("input[name='name_kr[]']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    name_krCheck = false;
                } else {
                    name_krCheck = true;
                    return false;
                }
            });

            if (!name_krCheck) {
                alert('저자 국문이름을 입력해주세요.');
                $("input[name='name_kr[]']").focus();
                return false;
            }

            let first_nameCheck = true;
            $("input[name='first_name[]']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    first_nameCheck = false;
                } else {
                    first_nameCheck = true;
                    return false;
                }
            });

            if (!first_nameCheck) {
                alert('저자 영문 FirstName을 입력해주세요.');
                $("input[name='first_name[]']").focus();
                return false;
            }

            let last_nameCheck = true;
            $("input[name='last_name[]']").each(function(index, item) {
                if (isEmpty($(item).val())) {
                    last_nameCheck = false;
                } else {
                    last_nameCheck = true;
                    return false;
                }
            });

            if (!last_nameCheck) {
                alert('저자 영문 LastName을 입력해주세요.');
                $("input[name='last_name[]']").focus();
                return false;
            }

            let affiliationCheck = 0;
            const _affiLength = $(".target-author").length;

            for (let i = 1; i <= _affiLength; i++) {
                let isChecked = $(`input[name^='affiliation_check_${i}']`).is(":checked");

                if (isChecked) {
                    affiliationCheck++;
                }
            }
            if( affiliationCheck < _affiLength ){
                alert('기관 및 소속을 체크해주세요.');
                return false;
            }

            if( $("input[name^='c_author_yn_']:visible").is(":checked") !== true ){
                alert('교신저자를 체크해주세요.');
                return false;
            }
            boardSubmit();
        });
    </script>
@endsection