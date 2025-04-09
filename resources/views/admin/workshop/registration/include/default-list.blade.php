<div class="table-wrap" style="margin-top: 10px;">
    <table class="cst-table list-table">
        <caption class="hide">목록</caption>

        <colgroup>
            <col style="width: 5%;">
            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 6%;">

            <col style="width: 8%;">
            <col style="width: 10%;">
            <col style="width: 8%;">
            <col style="width: 7%;">
            <col style="width: 6%;">

            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 8%;">
            <col style="width: 5%;">
            <col style="width: 5%;">

            <col style="width: 5%;">
            <col style="width: 5%;">
            <col style="width: 5%;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">접수번호</th>
            <th scope="col">참가구분</th>
            <th scope="col">등록구분</th>
            <th scope="col">이름</th>
            <th scope="col">직장명<br>(소속)</th>

            <th scope="col">이메일</th>
            <th scope="col">휴대폰번호</th>
            <th scope="col">셔틀버스<br>수요조사</th>
            <th scope="col">등록비</th>
            <th scope="col">결제상태</th>

            <th scope="col">결제방법</th>
            <th scope="col">결제일</th>
            <th scope="col">최초 등록일<br>최종 등록일</th>
            <th scope="col">메일 재발송</th>
            <th scope="col">영수증 출력</th>

            <th scope="col">거래명세서</th>
            <th scope="col">메모</th>
            <th scope="col">관리</th>
        </tr>
        </thead>

        <tbody>
        @forelse($list as $row)
            <tr data-sid="{{ $row->sid }}">
                <td>
                    <a href="{{ route('registration.preview',['sid'=>$row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="regist-pop" data-width="950" data-height="900" style="color: #5a5ad7;">
                        {{ $row->regnum ?? '' }}
                    </a>
                </td>
                <td>
                    <select class="form-item db-change" data-field="gubun">
                        <option value="">선택</option>
                        @foreach($workshopConfig['gubun'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->gubun ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-item db-change" data-field="category">
                        <option value="">선택</option>
                        @foreach($workshopConfig['category'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->category ?? '') == $key ? 'selected' : '' }}>{{ $val['name'] }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $row->name_kr ?? '' }}</td>
                <td>{{ $row->sosok_kr ?? '' }}</td>


                <td>{{ $row->email ?? '' }}</td>
                <td>{{ $row->phone ?? '' }}</td>
                <td>
                    <select class="form-item db-change" data-field="shuttle_yn">
                        <option value="">선택</option>
                        @foreach($workshopConfig['shuttle_yn'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->shuttle_yn ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ number_format($row->price ?? 0) ?? 0 }}</td>
                <td>
                    <select class="form-item db-change" data-field="payment_status">
                        <option value="">선택</option>
                        @foreach($workshopConfig['payment_status'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->payment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-item db-change" data-field="payment_method">
                        <option value="">선택</option>
                        @foreach($workshopConfig['payment_method'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->payment_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ !empty($row->payment_date) ? $row->payment_date->format('Y-m-d') : '' }}</td>
                <td>{{ $row->created_at ?? '' }}<br>{{ $row->complete_at ?? '' }}</td>
                <td>
                    @if(($row->status ?? '') == 'Y')
                    <a href="{{ route('registration.resend', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type1 call-popup" data-width="750" data-height="850" data-popup_name="resend-mail">
                        재발송
                    </a>
                    @endif
                </td>

                <td>
                    @if(($row->payment_status ?? '') == 'Y')
                        <a href="{{ route('registration.receipt',['sid'=>$row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type5 call-popup" data-popup_name="receipt-pop" data-width="800" data-height="900">영수증</a>
                    @endif
                </td>
                <td>
                    @if(($row->payment_status ?? '') == 'Y')
                    <a href="{{ route('registration.transaction',['sid'=>$row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type5 call-popup" data-popup_name="transaction-pop" data-width="900" data-height="700">거래명세서</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('registration.memo', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type18 call-popup" data-name="reg-memo" data-height="500">
                        메모
                    </a>
                </td>
                <td>
                    <a href="{{ route('registration.modify', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="member-upsert" data-width="950" data-height="900">
                        <img src="/assets/image/admin/ic_modify.png" alt="수정">
                    </a>

                    <a href="javascript:void(0);" class="btn-admin btn-del">
                        <img src="/assets/image/admin/ic_del.png" alt="삭제">
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="18">등록정보가 없습니다.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@section('regScript')
    <script>
        $(document).on('click', '.btn-del', function () {
            if (confirm('데이터 삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'registration-delete',
                    'sid': getPK(this),
                });
            }
        });
    </script>
@endsection