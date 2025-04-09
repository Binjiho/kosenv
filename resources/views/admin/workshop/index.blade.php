@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>학술대회 관리</h2>
        </div>

        <div class="btn-wrap text-left">
            <a href="{{ route('workshop.upsert') }}" class="btn btn-type1 color-type19 call-popup" data-popup_name="abstract-modify" data-width="1200" data-height="900">행사 등록</a>
        </div>

        <div class="table-wrap mb-50">
            <table class="cst-table abs-info-table">
                <colgroup>
                    <col style="width: 4%;">
                    <col>
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 6%">

                    <col style="width: 10%">
                    <col style="width: 6%">
                    <col style="width: 10%">
                    <col style="width: 6%">
                    <col style="width: 10%">

                    <col style="width: 6%">
                    <col style="width: 6%">
                </colgroup>
                <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>행사일/장소</th>
                    <th>사전등록 기간</th>
                    <th>사전등록</th>

                    <th>초록접수 기간</th>
                    <th>초록접수</th>
                    <th>후원신청 기간</th>
                    <th>후원신청</th>
                    <th>전시신청 기간</th>

                    <th>전시신청</th>
                    <th>관리</th>
                </tr>
                </thead>
                <tbody>
                @forelse($list as $row)
                    <tr data-sid="{{ $row->sid }}">
                        <td>{{ $row->seq }}</td>
                        <td>{{ $row->subject ?? '' }}</td>
                        <td>{{ $row->eventDate() }}<br>{{ $row->place ?? '' }}</td>
                        <td>{{ $row->regDate() }}</td>
                        <td>
                            <a href="{{ route('registration', ['work_code' => $row->work_code]) }}" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>

                        <td>{{ $row->absDate() }}</td>
                        <td>
                            <a href="{{ route('abstract', ['work_code' => $row->work_code]) }}" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>
                        <td>{{ $row->supportDate() }}</td>
                        <td>
                            <a href="{{ route('support', ['work_code' => $row->work_code]) }}" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>
                        <td>{{ $row->displayDate() }}</td>

                        <td>
                            <a href="javascript:alert('추후 업데이트 예정입니다.');" class="btn btn-small color-type1">
                                명단
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('workshop.upsert', ['sid' => $row->sid]) }}" class="btn-admin call-popup" data-name="workshop-upsert" data-width="1200" data-height="900">
                                <img src="/assets/image/admin/ic_modify.png" alt="수정">
                            </a>

                            <a href="javascript:void(0);" class="btn-admin btn-del">
                                <img src="/assets/image/admin/ic_del.png" alt="삭제">
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12">등록된 학술행사가 없습니다.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('workshop.data') }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-del', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'workshop-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
