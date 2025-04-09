<div class="table-wrap" style="margin-top: 10px;">
    <table class="cst-table list-table">
        <caption class="hide">목록</caption>

        <colgroup>
            <col style="width: 6%;">
            <col style="width: 6%;">
{{--            <col style="width: 6%;">--}}
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
            <col style="width: 5%;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">접수번호</th>
            <th scope="col">제출상태</th>
{{--            <th scope="col">참가구분</th>--}}
            <th scope="col">제출자 이름</th>
            <th scope="col">제출자 직장명<br>(소속)</th>

            <th scope="col">이메일</th>
            <th scope="col">대주제</th>
            <th scope="col">논문제목(국문)</th>
            <th scope="col">논문제목(영문)</th>
            <th scope="col">최초 등록일</th>

            <th scope="col">최종 수정일</th>
            <th scope="col">초록메일<br>재발송</th>
            <th scope="col">워드백업</th>
            <th scope="col">관리</th>
        </tr>
        </thead>

        <tbody>
        @forelse($list as $row)
            <tr data-sid="{{ $row->sid }}">
                <td>
                    <a href="{{ route('abstract.modify', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="abstract-upsert" data-width="1100" data-height="900" style="color: #5a5ad7;">
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
{{--                <td>--}}
{{--                    <select class="form-item db-change" data-field="category">--}}
{{--                        @foreach($workshopConfig['category'] as $key => $val)--}}
{{--                            <option value="{{ $key }}" {{ ($row->category ?? '') == $key ? 'selected' : '' }}>{{ $val['name'] }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </td>--}}
                <td>{{ $row->registration->name_kr ?? '' }}</td>
                <td>{{ $row->registration->sosok_kr ?? '' }}</td>


                <td>{{ $row->registration->email ?? '' }}</td>
                <td>
                    <select class="form-item db-change" data-field="topic">
                        <option value="">선택</option>
                        @foreach($workshopConfig['topic'] as $key => $val)
                            <option value="{{ $key }}" {{ ($row->topic ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
                <td>{{ $row->title_kr ?? '' }}</td>
                <td>{{ $row->title_en ?? '' }}</td>
                <td>{{ !empty($row->created_at) ? $row->created_at->format('Y-m-d') : '' }}</td>


                <td>{{ !empty($row->updated_at) ? $row->updated_at->format('Y-m-d') : '' }}</td>
                <td>
                    @if(($row->status ?? '') == 'Y')
                    <a href="{{ route('abstract.resend', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type1 call-popup" data-width="750" data-height="850" data-popup_name="resend-mail">
                        재발송
                    </a>
                    @endif
                </td>

                <td>
                    @if(($row->status ?? '') == 'Y')
                        <a href="{{ route('abstract.word',['sid'=>$row->sid, 'work_code'=>$row->work_code]) }}" class="btn btn-small color-type5" >워드백업</a>
                    @endif
                </td>
                <td>
                    <a href="{{ route('abstract.modify', ['sid' => $row->sid, 'work_code'=>$row->work_code]) }}" class="btn-admin call-popup" data-name="abstract-upsert" data-width="1100" data-height="900">
                        <img src="/assets/image/admin/ic_modify.png" alt="수정">
                    </a>

                    <a href="javascript:void(0);" class="btn-admin btn-del">
                        <img src="/assets/image/admin/ic_del.png" alt="삭제">
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="13">등록정보가 없습니다.</td>
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
                    'case': 'abstract-delete',
                    'sid': getPK(this),
                });
            }
        });
    </script>
@endsection