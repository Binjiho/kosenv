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
                    <a href="{{ route('registration',['work_code'=>request()->work_code]) }}">전체 list</a>
                </li>

                <li class="{{ request()->case == 'refund' ? 'on' : '' }}">
                    <a href="{{ route('registration', ['work_code'=>request()->work_code, 'case' => 'refund']) }}">환불 list</a>
                </li>

                <li class="{{ request()->case == 'elimination' ? 'on' : '' }}">
                    <a href="{{ route('registration', ['work_code'=>request()->work_code, 'case' => 'elimination']) }}">삭제 list</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('registration', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="sch-form-wrap">
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

                            <th scope="row">성명</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">직장명(소속)</th>
                            <td class="text-left">
                                <input type="text" name="sosok_kr" value="{{ request()->sosok_kr ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">이메일</th>
                            <td class="text-left">
                                <input type="text" name="email" value="{{ request()->email ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">휴대폰번호</th>
                            <td class="text-left">
                                <input type="text" name="phone" value="{{ request()->phone ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">참가 구분</th>
                            <td class="text-left">
                                <select name="gubun" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($workshopConfig['gubun'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->gubun ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">등록 구분</th>
                            <td class="text-left">
                                <select name="category" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($workshopConfig['category'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->category ?? '') == $key ? 'selected' : '' }}>{{ $val['name'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">셔틀버스 수요조사</th>
                            <td class="text-left">
                                <select name="shuttle_yn" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($workshopConfig['shuttle_yn'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->shuttle_yn ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">결제 방법</th>
                            <td class="text-left">
                                <select name="payment_method" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($workshopConfig['payment_method'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">결제 상태</th>
                            <td class="text-left">
                                <select name="payment_status" class="form-item">
                                    <option value="">전체</option>
                                    @foreach($workshopConfig['payment_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
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
                    <a href="{{ route('registration', ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('registration.excel', request()->except(['page']) + ['work_code'=>request()->work_code, 'case' => request()->case]) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
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
                        <td>참가 구분</td>
                        <td style="text-align: left; ">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['gubun'] as $key => $val)
                                {{ $val }} : {{ $gubunCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>등록 구분</td>
                        <td style="text-align: left; ">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['category'] as $key => $val)
                                {{ $val['name'] }} : {{ $categoryCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>셔틀버스 수요조사</td>
                        <td style="text-align: left; ">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['shuttle_yn'] as $key => $val)
                                {{ $val }} : {{ $shuttle_ynCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>결제 방법</td>
                        <td style="text-align: left; ">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['payment_method'] as $key => $val)
                                {{ $val }} : {{ $payment_methodCnt[$key] ?? 0 }}명 |
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>결제 상태</td>
                        <td style="text-align: left; ">
                            전체 : {{ $total_cnt ? number_format($total_cnt) : 0 }}명 |
                            @foreach($workshopConfig['payment_status'] as $key => $val)
                                {{ $val }} : {{ $payment_statusCnt[$key] ?? 0 }}명 |
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
            @case('refund' /* 환불 회원 */)
                @include('admin.workshop.registration.include.refund-list')
                @break

            @case('elimination' /* 삭제 회원 */)
                @include('admin.workshop.registration.include.elimination-list')
                @break

            @default
                @include('admin.workshop.registration.include.default-list')
                @break
        @endswitch

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('registration.data',['work_code'=>request()->work_code]) }}';

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

        //회원등급 변경
        // $(document).on('change', '.select-level', function () {
        //     callAjax(dataUrl, {
        //         'case': 'change-level',
        //         'sid': getPK(this),
        //         'value': $(this).val(),
        //     });
        // });
    </script>

    @yield('regScript')
@endsection
