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
                    <a href="{{ route('support',['work_code'=>request()->work_code]) }}">전체 list</a>
                </li>
                <li class="{{ request()->case == 'elimination' ? 'on' : '' }}">
                    <a href="{{ route('support', ['work_code'=>request()->work_code, 'case' => 'elimination']) }}">삭제 list</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('support', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="sch-form-wrap">
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

                            <th scope="row">회사명</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">담당자명</th>
                            <td class="text-left">
                                <input type="text" name="sosok_kr" value="{{ request()->sosok_kr ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">담당자 이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">구분</th>
                            <td class="text-left">
                                <select name="grade" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($workshopConfig['grade'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->grade ?? '') == $key ? 'selected' : '' }}>{{ $val['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">결제방법</th>
                            <td class="text-left">
                                <select name="spay_method" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($workshopConfig['spay_method'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->spay_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">결제상태</th>
                            <td class="text-left">
                                <select name="spayment_status" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($workshopConfig['spayment_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->spayment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
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
                    <a href="{{ route('support', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('support.excel', request()->except(['page']) + ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
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
                        <td>구분</td>
                        <td style="text-align: left">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['grade'] as $key => $val)
                                {{ $val['name'] }} : {{ $gradeCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>결제방법</td>
                        <td style="text-align: left">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['spay_method'] as $key => $val)
                                {{ $val }} : {{ $spay_methodCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>결제상태</td>
                        <td style="text-align: left">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['spayment_status'] as $key => $val)
                                {{ $val }} : {{ $spayment_statusCnt[$key] ?? 0 }}명 |
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
                @include('admin.workshop.support.include.elimination-list')
                @break

            @default
                @include('admin.workshop.support.include.default-list')
                @break
        @endswitch

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('support.data',['work_code'=>request()->work_code]) }}';

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
