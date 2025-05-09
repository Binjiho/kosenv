@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/gallery/assets/css/board.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />

    <style>
        .eDate-display {
            display: {{ ($board->date_type ?? '') == 'L' ? 'inline-block' : 'none' }}
        }
    </style>
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <!-- s:board -->
            <div id="board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" onsubmit="return false;" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-contop text-right">
                                    <div class="help-text"><strong class="required">*</strong> 표시는 필수입력 항목입니다.</div>
                                </div>

                                <ul class="write-wrap">
                                    @if($boardConfig['use']['gubun'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 행사 구분</div>

                                            <div class="form-con">
                                                @switch($boardConfig['gubun']['type'])
                                                    @case('radio')
                                                        <div class="radio-wrap cst">
                                                            @foreach($boardConfig['gubun']['item'] as $key => $val)
                                                                <div class="radio-group">
                                                                    <input type="radio" name="gubun" id="gubun_{{ $key }}" value="{{ $key }}" {{ (($board->gubun ?? '') == $key) ? 'checked' : '' }}>
                                                                    <label for="gubun_{{ $key }}">{{ $val }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @break

                                                    @case('select')
                                                        <select name="gubun">
                                                            <option value="">선택</option>
                                                            @foreach($boardConfig['gubun']['item'] as $key => $val)
                                                                <option value="{{ $key }}" {{ (($board->gubun ?? '') == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        @break
                                                @endswitch
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['writer'])
                                        <li>
                                            <div class="form-tit">작성자</div>
                                            <div class="form-con">{{ env('APP_NAME') }}</div>
                                            <input type="hidden" name="name" value="{{ env('APP_NAME') }}" readonly>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['subject'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 행사명</div>

                                            <div class="form-con">
                                                <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">

                                                <div class="checkbox-wrap cst mt-10">
                                                    @if($boardConfig['use']['notice'])
                                                        <label class="checkbox-group"><input type="checkbox" name="notice" value="Y"  id="chk-tit1" {{ ($board->notice ?? '') == 'Y' ? 'checked' : '' }}>공지</label>
                                                    @endif
                                                    @if($boardConfig['use']['main'])
                                                        <label class="checkbox-group"><input type="checkbox" name="main" value="Y" id="chk-tit2" {{ ($board->main ?? '') == 'Y' ? 'checked' : '' }}>Main 노출</label>
                                                    @endif
                                                </div>

                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['secret'])
                                        <li>
                                            <div class="form-tit">비밀글</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['secret'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="secret" id="secret_{{ $key }}" value="{{ $key }}" {{ (($board->secret ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="secret_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['category'])
                                        <li>
                                            <div class="form-tit">{{ $boardConfig['category']['name'] }}</div>

                                            <div class="form-con">
                                                @switch($boardConfig['category']['type'])
                                                    @case('radio')
                                                        <div class="radio-wrap cst">
                                                            @foreach($boardConfig['category']['item'] as $key => $val)
                                                                <div class="radio-group">
                                                                    <input type="radio" name="category" id="category_{{ $key }}" value="{{ $key }}" {{ (($board->category ?? '') == $key) ? 'checked' : '' }}>
                                                                    <label for="category_{{ $key }}">{{ $val }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @break

                                                    @case('select')
                                                        <select name="category" id="category" class="form-item">
                                                            <option value="">선택</option>
                                                            @foreach($boardConfig['category']['item'] as $key => $val)
                                                                <option value="{{ $key }}" {{ (($board->category ?? '') == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        @break
                                                @endswitch
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['date'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 행사기간</div>
                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['date_type'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="date_type" id="date_type_{{ $key }}" value="{{ $key }}" {{ ($board->date_type ?? '') == $key ? 'checked' : '' }}>
                                                            <label for="date_type_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> {{ $boardConfig['date']['name'] }}</div>
                                            <div class="form-con">
                                                <div class="form-group form-group-text n4">
                                                    <input type="text" name="event_sDate" id="event_sDate" class="form-item" value="{{ $board->event_sDate ?? '' }}" readonly datepicker>
                                                    <input type="time" name="event_sTime" id="event_sTime" class="form-item" value="{{ $board->event_sTime ?? '' }}">
                                                    <span class="text eDate-display">~</span>
                                                    <input type="text" name="event_eDate" id="event_eDate" class="form-item eDate-display" value="{{ $board->event_eDate ?? '' }}" readonly datepicker>
                                                    <input type="time" name="event_eTime" id="event_eTime" class="form-item eDate-display" value="{{ $board->event_eTime ?? '' }}">
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['place'])
                                        <li>
                                            <div class="form-tit">장소</div>

                                            <div class="form-con">
                                                <input type="text" name="place" id="place" class="form-item" value="{{ $board->place ?? '' }}">
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['link'])
                                        <li>
                                            <div class="form-tit">Homepage</div>

                                            <div class="form-con">
                                                <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $board->link_url ?? '' }}">
                                            </div>
                                        </li>
                                    @endif

                                        @if($boardConfig['use']['thumbnail'])
                                            <li>
                                                <div class="form-tit">{{ $boardConfig['thumbnail']['name'] }}</div>
                                                <div class="form-con">
                                                    <div class="filebox">
                                                        <input class="upload-name form-item" id="thumbnail_name" placeholder="파일첨부" readonly="readonly">
                                                        <label for="thumbnail">파일찾기</label>
                                                        <input type="file" name="thumbnail" id="thumbnail" class="file-upload" accept=".jpg, .png, .gif" data-accept="jpg|png|gif">

                                                        @if (!empty($board->thumbnail_filename))
                                                            <div class="attach-file">
                                                                <a href="{{ $board->downloadUrl('thumbnail') }}" class="link">
                                                                    {{ $board->thumbnail_filename }}
                                                                </a>

                                                                <a href="javascript:void(0);" class="btn-file-delete text-red">X</a>
                                                            </div>

                                                            <input type="hidden" name="thumbnail_del" id="thumbnail_del">
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endif

                                    @if($boardConfig['use']['hide'])
                                        <li>
                                            <div class="form-tit"><strong class="required">*</strong> 공개 여부</div>

                                            <div class="form-con">
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ (($board->hide ?? '') == $key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif



                                    @if($boardConfig['use']['file'])
                                        @foreach($boardConfig['file'] as $key => $val)
                                            <li>
                                                <div class="form-tit">{{ $val['name'] }}</div>

                                                <div class="form-con">
                                                    <input type="text" id="file{{ $key }}_name" class="form-item" readonly>
                                                    <input type="file" name="file{{ $key }}" id="file{{ $key }}">

                                                    @if (!empty($board->{"realfile{$key}"}))
                                                        <div style="display: flex; align-items: center">
                                                            <input type="checkbox" name="file{{ $key }}_del" id="file{{ $key }}_del">
                                                            <label for="file{{ $key }}_del" style="margin-left: 0.3rem; margin-right: 0.5rem;"> 삭제 - </label>

                                                            <a href="{{ $board->downloadUrl($key) }}">
                                                                {{ $board->{"filename{$key}"} }}
                                                            </a>

                                                            <span style="margin-left: 0.3rem;">(다운 : {{ number_format($board->{"file{$key}_download"}) }})</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif

                                    @if($boardConfig['use']['plupload'] && ($board->files_count ?? 0) > 0)
                                        <li>
                                            <div class="form-tit">첨부파일</div>

                                            <div class="form-con">
                                                @foreach($board->files as $key => $file)
                                                    <div style="display: flex; align-items: center">
                                                        <input type="checkbox" name="plupload_file_del[]" id="plupload_file_del{{ $key }}" value="{{ $file->sid }}">
                                                        <label for="plupload_file_del{{ $key }}" style="margin-left: 0.3rem; margin-right: 0.5rem;"> 삭제 - </label>

                                                        <a href="{{ $file->downloadUrl() }}">
                                                            {{ $file->filename }}
                                                        </a>

                                                        <span style="margin-left: 0.3rem;">(다운 : {{ number_format($file->download) }})</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['contents'])
                                        <li>
                                            <div class="form-con">
                                                <textarea name="contents" id="contents" class="tinymce">{{ $board->contents ?? '' }}</textarea>
                                            </div>
                                        </li>
                                    @endif

                                    @if($boardConfig['use']['plupload'])
                                        <li>
                                            <div class="form-con">
                                                <div id="plupload"></div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>

                                <div class="btn-wrap text-center">
                                    <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-type1 color-type7">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type9">{{ !empty($board->sid) ? '수정' : '등록' }}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <!-- //e:board -->
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    <script>
        // 게시글 작성 취소
        $(document).on('click', '.btn-cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                location.replace('{{ route('board', ['code' => $code]) }}');
            }
        });


        // 기간설정 사용시
        if(boardConfig.use.date) {
            $(document).on('click', 'input:radio[name=date_type]', function() {
                if ($(this).val() === "L") {
                    $('.eDate-display').show();
                } else {
                    $('.eDate-display').hide();
                    $('input[name=event_eDate]').val('');
                    $('input[name=event_eTime]').val('');
                }
            });

            // 행사기간 날짜 체크
            $.validator.addMethod('isEventDateEmpty', function(value, element) {
                if (element.name == 'event_eDate') {
                    return $('input:radio[name=date_type]:checked').val() == 'D' ? true : !isEmpty(value);
                }

                return !isEmpty(value);
            });
        }

        // 구분 or 카테고리 사용시
        if(boardConfig.use.category || boardConfig.use.gubun) {
            $.validator.addMethod('isCategoryEmpty', function(value, element) {
                const name = element.name;

                if ($(`input:radio[name='${name}']`).length > 0) {
                    return $(`input:radio[name='${name}']:checked`).length > 0;
                }

                if ($(`select[name='${name}']`).length > 0) {
                    return !isEmpty($(`select[name='${name}']`).val());
                }
            });
        }

        // 첨부파일 (plupload) 사용시
        if(boardConfig.use.plupload) {
            pluploadInit({
                multipart_params: {
                    directory: boardConfig.directory,
                },
                filters: {
                    max_file_size: '20mb'
                },
            });
        }

        // 첨부파일 (단일파일) or 썸네일 사용시
        if(boardConfig.use.file || boardConfig.use.thumbnail) {
            $(document).on('click', 'input[type=file]', function (e) {
                const target = $(this).closest('.filebox').find('.attach-file');

                if (!fileDelCheck(target)) {
                    e.preventDefault();
                }
            });

            $(document).on('change', 'input[type=file]', function () {
                const name = $(this).attr('name');
                fileCheck(this, `#${name}_name`);
            });

            $(document).on('click', '.btn-file-delete', function () {
                const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
                const target = $(this).closest('.filebox').find('.attach-file');

                target.remove();
                $(`#${name}_del`).val('Y');
            });
        }


        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['contents', 'popup_contents'],
            rules: {
                gubun: {
                    isCategoryEmpty: true,
                },
                category: {
                    isCategoryEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                secret: {
                    checkEmpty: true,
                },
                password: {
                    isSecretPw: true,
                },
                // notice_sDate: {
                //     isNoticeDate: true,
                // },
                // notice_eDate: {
                //     isNoticeDate: true,
                // },
                hide: {
                    checkEmpty: true,
                },
                date_type: {
                    checkEmpty: true,
                },
                event_sDate: {
                    isEventDateEmpty: true,
                },
                event_eDate: {
                    isEventDateEmpty: true,
                },
                // place: {
                //     isEmpty: true,
                // },
                // link_url: {
                //     isEmpty: true,
                // },
                popup: {
                    checkEmpty: true,
                },
                popup_skin: {
                    popupCheckEmpty: true,
                },
                popup_select: {
                    popupCheckEmpty: true,
                },
                width: {
                    popupIsEmpty: true,
                    popupSize: true,
                },
                height: {
                    popupIsEmpty: true,
                    popupSize: true,
                },
                position_x: {
                    popupIsEmpty: true,
                },
                position_y: {
                    popupIsEmpty: true,
                },
                popup_detail: {
                    popupCheckEmpty: true,
                },
                popup_link: {
                    popupLinkIsEmpty: {
                        depends: function(element) {
                            return $("input[name='popup_detail']:checked").val()==='Y';
                        },
                    },
                },
                popup_sDate: {
                    popupIsEmpty: true,
                },
                popup_eDate: {
                    popupIsEmpty: true,
                },
                popup_contents: {
                    PopupIsTinyEmpty: true,
                },
                // contents: {
                //     isTinyEmpty: true,
                // },
            },
            messages: {
                gubun: {
                    isCategoryEmpty: '행사구분을 선택해주세요.',
                },
                category: {
                    isCategoryEmpty: `${boardConfig.category.name}를 선택해주세요.`,
                },
                subject: {
                    isEmpty: '행사명을 입력해주세요.',
                },
                secret: {
                    checkEmpty: '비밀글 사용을 선택해주세요.',
                },
                password: {
                    isSecretPw: '비밀번호를 입력해주세요.',
                },
                notice_sDate: {
                    isNoticeDate: '공지 시작일을 선택해주세요.',
                },
                notice_eDate: {
                    isNoticeDate: '공지 종료일을 선택해주세요.',
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
                date_type: {
                    checkEmpty: '행사기간을 설정 해주세요.',
                },
                event_sDate: {
                    isEventDateEmpty: '행사 일자 시작일을 선택해주세요.',
                },
                event_eDate: {
                    isEventDateEmpty: '행사 일자 종료일을 선택해주세요.',
                },
                place: {
                    isEmpty: '장소를 입력해주세요.',
                },
                link_url: {
                    isEmpty: '링크를 입력해주세요.',
                },
                popup: {
                    checkEmpty: '팝업 설정을 체크해주세요.',
                },
                popup_skin: {
                    popupCheckEmpty: '팝업 템플릿을 선택해주세요.',
                },
                popup_select: {
                    popupCheckEmpty: '팝업 내용을 선택해주세요.',
                },
                width: {
                    popupIsEmpty: '팝업 가로 사이즈를 입력해주세요.',
                    popupSize: (popupMinWidth + ' 이상 입력해주세요.'),
                },
                height: {
                    popupIsEmpty: '팝업 세로 사이즈를 입력해주세요.',
                    popupSize: (popupMinHeight + ' 이상 입력해주세요.'),
                },
                position_x: {
                    popupIsEmpty: '팝업 위에서 위치를 입력해주세요.',
                },
                position_y: {
                    popupIsEmpty: '팝업 왼쪽에서 위치를 입력해주세요.',
                },
                popup_detail: {
                    popupCheckEmpty: '팝업 자세히 보기를 선택해주세요.',
                },
                popup_link: {
                    popupLinkIsEmpty: '자세히 보기 LINK 를 입력해주세요. ',
                },
                popup_sDate: {
                    popupIsEmpty: '팝업 시작일을 선택해주세요.',
                },
                popup_eDate: {
                    popupIsEmpty: '팝업 종료일을 선택해주세요.',
                },
                popup_contents: {
                    PopupIsTinyEmpty: '팝업 내용을 입력해주세요.',
                },
                contents: {
                    isTinyEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function() {
                if(boardConfig.use.plupload) { // plupload 사용할때
                    const plupload_queue = $('#plupload').pluploadQueue();

                    let fileCnt = plupload_queue.files.length;
                    fileCnt = (fileCnt - previousUploadedFilesCount);

                    if (fileCnt > 0) {
                        spinnerShow();
                        plupload_queue.start();
                        plupload_queue.bind('UploadComplete', function(up, files) {
                            spinnerHide();

                            if (plupload_queue.total.failed !== 0) {
                                alert('파일 업로드 실패');
                                location.reload();
                                return false;
                            }

                            // 업로드된 파일 수를 저장
                            previousUploadedFilesCount = up.files.length;
                            boardSubmit();
                        });

                        return false;
                    }
                }
                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);

            // 내용 사용시
            if(boardConfig.use.contents) {
                ajaxData.append('contents', tinymce.get('contents').getContent());
            }

            // 팝업 사용시
            if(boardConfig.use.popup) {
                ajaxData.append('popup_contents', tinymce.get('popup_contents').getContent());
            }

            // plupload 사용시
            if(boardConfig.use.plupload) {
                ajaxData.append('plupload_file', JSON.stringify(plupladFile));
            }

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
