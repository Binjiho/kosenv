@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <div class="sub-contents">
        <div class="sub-tab-wrap">
            <ul class="sub-tab-menu cf">
                <li class="{{ empty($listCase) ? 'on' : '' }}">
                    <a href="{{ route('abstract',['work_code'=>request()->work_code]) }}">전체 list</a>
                </li>
                <li class="{{ request()->case == 'elimination' ? 'on' : '' }}">
                    <a href="{{ route('abstract', ['work_code'=>request()->work_code, 'case' => 'elimination']) }}">삭제 list</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('abstract', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="sch-form-wrap">
            <fieldset>
                <legend class="hide">검색</legend>
                <div class="table-wrap">
                    <table class="cst-table">
                        <colgroup>
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="row">접수번호</th>
                            <td class="text-left">
                                <input type="text" name="regnum" value="{{ request()->regnum ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">접수자 성명</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">접수자 직장명(소속)</th>
                            <td class="text-left">
                                <input type="text" name="sosok_kr" value="{{ request()->sosok_kr ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">접수자 이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">교신저자 이름(국문)</th>
                            <td class="text-left">
                                <input type="text" name="author_kr" value="{{ request()->author_kr ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">소속(국문)</th>
                            <td class="text-left">
                                <input type="text" name="affi_kr" value="{{ request()->affi_kr ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">등록 구분</th>
                            <td class="text-left">
                                <select name="topic" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($workshopConfig['topic'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->topic ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">초록 제목(국문,영문)</th>
                            <td class="text-left" colspan="3">
                                <input type="text" name="title_kr" value="{{ request()->title_kr ?? '' }}" class="form-item">
                            </td>

                        </tr>

                        <tr>
                            <th scope="row">제출 상태</th>
                            <td class="text-left">
                                <select name="status" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($workshopConfig['status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row"></th>
                            <td class="text-left"></td>
                            <th scope="row"></th>
                            <td class="text-left"></td>
                        </tr>


                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('abstract', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('abstract.excel', request()->except(['page']) + ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
                    <a href="{{ route('abstract.word', ['work_code'=>request()->work_code, 'case' => request()->case] + request()->except(['page'])) }}" class="btn btn-type1 color-type5">워드 백업</a>
{{--                    <a href="{{ route('abstract.word.preview', ['work_code'=>request()->work_code, 'case' => request()->case] + request()->except(['page'])) }}" class="btn btn-type1 color-type3 call-popup" data-width="900" data-popup_name="word-preview">Get Word Preview</a>--}}
                    <a href="{{ route('workshop') }}" class="btn btn-type1 color-type15">목록 이동</a>
                </div>
            </fieldset>
        </form>

        <div class="table-wrap mb-50 ">
            <table class="cst-table abs-info-table">
                <colgroup>
                    <col style="width: 20%;">
                    <col style="width: 80%;">

                </colgroup>

                <thead>
                    <tr>
                        <th colspan="2">
                            통계현황 <a href="javascript:;" class="btn btn-small color-type1 trigger">닫기</a>
                        </th>
                    </tr>
                </thead>

                <tbody class="toggleArea">
                    <tr>
                        <td>대주제</td>
                        <td style="text-align: left;">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['topic'] as $key => $val)
                                {{ $val }} : {{ $topicCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>제출상태</td>
                        <td style="text-align: left;">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['status'] as $key => $val)
                                {{ $val }} : {{ $statusCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong>명]
            </span>

            @include('admin.layouts.include.li_page')
        </div>

        @switch(request()->case)
            @case('elimination' /* 삭제 회원 */)
                @include('admin.workshop.abstract.include.elimination-list')
                @break

            @default
                @include('admin.workshop.abstract.include.default-list')
                @break
        @endswitch

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('abstract.data',['work_code'=>request()->work_code]) }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.trigger', function(){
            const _isVisible = $(".toggleArea").is(":visible");
            if(_isVisible === true){
                $(".toggleArea").hide();
                $(this).text('열기');
            }else{
                $(".toggleArea").show();
                $(this).text('닫기');
            }
        });

        $(document).on('change', '.db-change', function () {
            callAjax(dataUrl, {
                'case': 'db-change',
                'sid': getPK(this),
                'field': $(this).data('field'),
                'value': $(this).val(),
            });
        });

    </script>

    @yield('regScript')
@endsection
