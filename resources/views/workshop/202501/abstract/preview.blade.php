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
                        <li class="on"><a href="{{ route('abstract.check',['work_code'=>$work_code]) }}"><span>YEP 초록접수</span></a></li>
                        <li><a href="{{ route('abstract.search',['work_code'=>$work_code]) }}"><span>YEP 초록접수 조회 및 수정</span></a></li>
                    </ul>
                </div>

                <form id="regFrm" method="post" action="{{ route('abstract.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($abs->sid) ? $abs->sid : '' }}" data-case="abstract-complete">

                    <fieldset>
                        <legend class="hide">초록접수 미리보기</legend>
                        <div class="write-tit-wrap bg-green">
                            <img src="/target/202501/assets/image/sub/ic_abstract_write.png" alt="">
                            <div class="text-wrap">
                                <p class="tit">{{ $workshop->subject ?? '' }} 초록 등록</p>
                                <p class="des">초록접수 마감일 : {!! $endDate ?? '' !!}</p>
                            </div>
                        </div>

                        <div class="bg-box bg-orange text-center">
                            입력하신 내용을 확인하신 후, 수정할 사항이 없다면 아래의 등록 <strong class="text-orange">최종 완료</strong> 버튼을 클릭해 주세요.<br>
                            또한, 등록 완료 메일을 받아야 최종 등록이 완료 됩니다.
                        </div>

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
                                    <td colspan="3" class="text-left">{{ $workshopConfig['gubun'][$reg->gubun] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>대한환경공학회 홈페이지 회원여부</th>
                                    <td class="text-left">{{ $workshopConfig['user_chk'][$reg->user_chk] ?? '' }}</td>
                                    <th>국적</th>
                                    <td class="text-left">{{ $reg_country->cn ?? '' }}</td>
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
                                    <div class="form-con">{{ $workshopConfig['topic'][$abs->topic] ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit"><strong class="required">*</strong> 논문 제목 (국문)</div>
                                    <div class="form-con">{{ $abs->title_kr ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit"><strong class="required">*</strong> 논문 제목 (영문)</div>
                                    <div class="form-con">{{ $abs->title_en ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit"><strong class="required">*</strong> 초록 (Abstract)</div>
                                    <div class="form-con">{!! $abs->contents ?? '' !!}</div>
                                </li>
                                <li>
                                    <div class="form-tit"><strong class="required">*</strong> 주제어 (Keywords)</div>
                                    <div class="form-con">{{ $abs->keyword1 ?? '' }} {{ $abs->keyword2 ?? '' }} {{ $abs->keyword3 ?? '' }} {{ $abs->keyword4 ?? '' }} {{ $abs->keyword5 ?? '' }}</div>
                                </li>
                                <li>
                                    <div class="form-tit">시사 (Acknowledgment)</div>
                                    <div class="form-con">{{ $abs->ack ?? '' }}</div>
                                </li>
                            </ul>
                        </div>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-tit">저자 정보</h4>
                        </div>

                        <div class="write-wrap n-bd">
                            <div class="table-wrap mt-0">
                                <table class="cst-table">
                                    <caption class="hide">저자 추가</caption>
                                    <colgroup>
                                        <col style="width:80px;">
                                        <col style="width:90px;">
                                        <col style="width:25%;">
                                        <col>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>교신저자</th>
                                        <th>이름</th>
                                        <th>기관 및 소속</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($abs->authors as $key => $row)
                                        <tr>
                                            <th class="text-center">{{ $key+1 }}</th>
                                            <td>
                                                <div class="checkbox-wrap cst">
                                                    <label class="checkbox-group no-text"><input type="checkbox" name="" disabled {{ ($row->c_author_yn ?? 'N') == 'Y' ? 'checked' : '' }}></label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $row->name_kr ?? '' }}<br>
                                                {{ $row->first_name ?? '' }} {{ $row->last_name ?? '' }}
                                            </td>
                                            <td class="text-left">
                                                @if(!empty($row->affiliation))
                                                    @foreach($row->affiliation as $idx => $val)
                                                        {{ $idx+1 }}. {{ $abs->affiliations[$idx]['affi_kr'] ?? '' }} / {{ $abs->affiliations[$idx]['affi_en'] ?? '' }}<br>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        @include('workshop.'.$work_code.'.'.'abstract.form.preview-frm')
                    </fieldset>
                    <div class="btn-wrap text-center">
                        @if( strpos(request()->getUri(),'mypage') === false)
                            <a href="javascript:;" id="post" class="btn btn-type1 color-type3">최종 제출</a>
                        @endif
                        <a href="{{ route('abstract',['work_code'=>$work_code,'sid'=>$abs->sid]) }}" class="btn btn-type1 color-type2">수정하기</a>
                        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn btn-type1 color-type4">취소</a>
                    </div>
                </form>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#regFrm';
        const dataUrl = '{{ route('abstract.data',['work_code'=>$work_code]) }}';

        $(document).on('click','#post',function(){
            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        });
    </script>
@endsection
