@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="sub-contents">
        <div class="sub-tab-wrap">
            <ul class="sub-tab-menu cf">
                <li class="{{ empty($feeCase) ? 'on' : '' }}">
                    <a href="{{ route('fee') }}">전체회원</a>
                </li>

                <li class="{{ request()->case == 'full' ? 'on' : '' }}">
                    <a href="{{ route('fee', ['case' => 'full']) }}">완납회원</a>
                </li>

                <li class="{{ request()->case == 'unpaid' ? 'on' : '' }}">
                    <a href="{{ route('fee', ['case' => 'unpaid']) }}">미납회원</a>
                </li>
            </ul>
        </div>

        <form id="searchF" name="searchF" action="{{ route('fee', $feeCase) }}" class="sch-form-wrap">
            <fieldset>
                <legend class="hide">검색</legend>
                <div class="table-wrap">
                    <table class="cst-table">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="row">회원등급</th>
                            <td class="text-left" colspan="3">
                                <select name="level" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($userConfig['level'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->level ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

{{--                            <th scope="row">면허번호</th>--}}
{{--                            <td class="text-left">--}}
{{--                                <input type="text" name="license_number" value="{{ request()->license_number ?? '' }}" class="form-item">--}}
{{--                            </td>--}}
                        </tr>

                        <tr>
                            <th scope="row">회원 ID</th>
                            <td class="text-left">
                                <input type="text" name="id" value="{{ request()->id ?? '' }}" class="form-item">
                            </td>

                            <th scope="row">이름</th>
                            <td class="text-left">
                                <input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}" class="form-item">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">회비 연도</th>
                            <td class="text-left">
                                <select name="year" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['year'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->year ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">회비 구분</th>
                            <td class="text-left">
                                <select name="category" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['category'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->category ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">납부방법</th>
                            <td class="text-left">
                                <select name="payment_method" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['payment_method'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th scope="row">납부상태</th>
                            <td class="text-left">
                                <select name="payment_status" class="form-item">
                                    <option value="">전체</option>

                                    @foreach($feeConfig['payment_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <input type="hidden" name="li_page" value="{{ $li_page }}" readonly>

                <div class="btn-wrap text-center">
                    <button type="submit" class="btn btn-type1 color-type17">검색</button>
                    <a href="{{ route('fee', $feeCase) }}" class="btn btn-type1 color-type18">검색 초기화</a>
                    <a href="{{ route('fee.excel', request()->except(['page']) + $feeCase) }}" class="btn btn-type1 color-type19">데이터 엑셀 백업</a>
                </div>
            </fieldset>
        </form>

        <div class="list-contop text-left cf">
            <a href="javascript:void(0);" class="btn btn-small btn-type1 color-type20" id="renew-btn">
                회비 갱신
            </a>
        </div>

        <div class="list-contop text-right cf">
            <span class="cnt full-left">
                [총 <strong>{{ number_format($list->total()) }}</strong>개]
            </span>

            <a href="{{ route('fee.upsert') }}" class="btn btn-small btn-type1 color-type20 call-popup" data-width="850" data-name="fee-upsert">
                회비 등록
            </a>

            @include('admin.layouts.include.li_page')
        </div>

        <div class="table-wrap" style="margin-top: 10px;">
            <table class="cst-table list-table">
                <caption class="hide">목록</caption>

                <colgroup>
                    <col style="width: 3%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 4%;">

                    <col style="width: 5%;">
                    <col style="width: 5%;">
                    <col style="width: 4%;">
                    <col style="width: 4%;">
                    <col style="width: 5%;">

                    <col style="width: 6%;">
                    <col style="width: 5%;">
                    <col style="width: 6%;">
                    <col style="width: 6%;">

                </colgroup>

                <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">회원등급-세부등급</th>
                    <th scope="col">이름</th>
                    <th scope="col">아이디</th>
                    <th scope="col">직장명<br>(기관명)</th>

                    <th scope="col">회비 연도</th>
                    <th scope="col">회비 구분</th>
                    <th scope="col">금액</th>
                    <th scope="col">납부방법</th>
                    <th scope="col">납부상태</th>

                    <th scope="col">납부일자</th>
                    <th scope="col">영수증</th>
                    <th scope="col">회비내역</th>
                    <th scope="col">관리</th>
                </tr>
                </thead>

                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $userConfig['level'][$row->user->level ?? ''] ?? '' }}</td>
                        <td>{{ $row->user->name_kr ?? '' }}</td>
                        <td>{{ $row->user->id ?? '' }}</td>
                        <td>{{ $row->user->company ?? '' }}</td>

                        <td>{{ $row->year ?? '' }}</td>
                        <td>{{ $feeConfig['category'][$row->category ?? ''] ?? '' }}</td>
                        <td>{{ $row->price ?? '' }}</td>
                        <td>{{ $feeConfig['payment_method'][$row->payment_method ?? ''] ?? '' }}</td>
                        <td>
                            <select class="form-item payment-status">
                                @foreach($feeConfig['payment_status'] as $key => $val)
                                    <option value="{{ $key }}" {{ $row->payment_status == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            @if(!empty($row->payment_date) && isValidTimestamp($row->payment_date))
                                {{ $row->payment_date ?? '' }}
                            @endif
                        </td>
                        <td>
                            @if(($row->payment_status ?? '') == 'Y')
                                <a href="{{ route('fee.receipt',['user_sid'=>$row->user->sid, 'tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="550">영수증</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('fee.popup.all-list', ['user_sid' => $row->user_sid]) }}" class="btn btn-small color-type5 call-popup" data-width="1400" data-height="800" data-name="fee-all-list">
                                전체내역
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('fee.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-popup_name="fee-upsert" data-width="950" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14">회비내역이 없습니다.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('fee.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '#renew-btn', function () {
            if (confirm('회비를 갱신 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'fee-renew',
                });
            }
        });

        // $(document).on('change', '.payment-status', function () {
        //     const _this = this;
        //     const sid = getPK(_this);
        //
        //     callAjax(dataUrl, {
        //         'case': 'db-change',
        //         'sid': sid,
        //         'field': 'payment_status',
        //         'value': $(_this).val(),
        //     });
        // });

        //납부상태 변경
        $(document).on('change', '.payment-status', function () {
            callAjax(dataUrl, {
                'case': 'change-payment_status',
                'sid': getPK(this),
                'value': $(this).val(),
            });
        });

        $(document).on('click', '.btn-del', function () {
            const _this = this;
            const sid = getPK(_this);

            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'fee-delete',
                    'sid': sid,
                });
            }
        });
    </script>
@endsection
