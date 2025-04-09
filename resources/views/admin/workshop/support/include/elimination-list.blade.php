<div class="table-wrap" style="margin-top: 10px;">
    <table class="cst-table list-table">
        <caption class="hide">목록</caption>

        <colgroup>
            <col style="width: 6%;">
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
            <col style="width: 6%;">
            <col style="width: 6%;">
            <col style="width: 5%;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">접수번호</th>
            <th scope="col">상태</th>
            <th scope="col">회사명</th>
            <th scope="col">담당자명</th>
            <th scope="col">담당자 핸드폰</th>
            <th scope="col">담당자 이메일</th>

            <th scope="col">구분</th>
            <th scope="col">금액</th>
            <th scope="col">결제방법</th>
            <th scope="col">결제상태</th>
            <th scope="col">입금예정일</th>

            <th scope="col">최초 등록일</th>
            <th scope="col">최종 결제일</th>
            <th scope="col">메일<br>재발송</th>
            <th scope="col">관리</th>
        </tr>
        </thead>

        <tbody>
        @forelse($list as $row)
            <tr data-sid="{{ $row->sid }}">
                <td>
                    <a href="{{ route('support.modify', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="support-upsert" data-width="1100" data-height="900" style="color: #5a5ad7;">
                        {{ $row->regnum ?? '' }}
                    </a>
                </td>
                <td>
                    <select class="form-item db-change" data-field="status">
                        <option value="">선택</option>
                        @foreach($workshopConfig['status'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $row->company ?? '' }}</td>
                <td>{{ $row->manager ?? '' }}</td>
                <td>{{ $row->phone ?? '' }}</td>
                <td>{{ $row->email ?? '' }}</td>

                <td>
                    <select class="form-item db-change" data-field="grade">
                        <option value="">선택</option>
                        @foreach($workshopConfig['grade'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->grade ?? '') == $key ? 'selected' : '' }}>{{ $val['name'] }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ number_format($row->price ?? 0) ?? 0 }}</td>
                <td>
                    <select class="form-item db-change" data-field="spay_method">
                        <option value="">선택</option>
                        @foreach($workshopConfig['spay_method'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->spay_method ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="form-item db-change" data-field="spayment_status">
                        <option value="">선택</option>
                        @foreach($workshopConfig['spayment_status'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->spayment_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ !empty($row->deposit_date) ? $row->deposit_date->format('Y-m-d') : '' }}</td>

                <td>{{ !empty($row->created_at) ? $row->created_at->format('Y-m-d') : '' }}</td>
                <td>{{ !empty($row->payment_date) ? $row->payment_date->format('Y-m-d') : '' }}</td>
                <td>
                    @if(($row->status ?? '') == 'Y')
                        <a href="{{ route('support.resend', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type1 call-popup" data-width="750" data-height="850" data-popup_name="resend-mail">
                            재발송
                        </a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('support.modify', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="support-upsert" data-width="1100" data-height="900">
                        <img src="/assets/image/admin/ic_modify.png" alt="수정">
                    </a>

                    <a href="javascript:void(0);" class="btn-admin restore">
                        <img src="/assets/image/admin/restore.png" alt="복원" style="width: 27px; height: 27px;">
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="14">등록정보가 없습니다.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@section('regScript')
    <script>
        $(document).on('click', '.restore', function () {
            if (confirm('데이터를 원복하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'support-restore',
                    'sid': getPK(this),
                });
            }
        });
    </script>
@endsection