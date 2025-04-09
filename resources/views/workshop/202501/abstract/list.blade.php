@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu">
                    <li ><a href="{{ route('abstract.info',['work_code'=>$work_code]) }}"><span>YEP 초록접수 안내</span></a></li>
                    <li ><a href="{{ route('abstract.check',['work_code'=>$work_code]) }}"><span>YEP 초록접수</span></a></li>
                    <li class="on"><a href="{{ route('abstract.search',['work_code'=>$work_code]) }}"><span>YEP 초록접수 조회 및 수정</span></a></li>
                </ul>
            </div>
            <div class="img-border-box">
                <img src="/target/202501/assets/image/sub/ic_abstract.png" alt="">
                <div class="text-wrap">
                    <ul class="list-type list-type-bar">
                        <li>초록수정 및 삭제 기간 : {!! $endDate ?? '' !!}</li>
                    </ul>
                    <ul class="list-type list-type-mark">
                        <li>접수 초록의 수정 버튼을 클릭하면 수정모드로 이동합니다.</li>
                        <li>접수 초록의 삭제 버튼을 클릭하면 접수하신 초록이 삭제 됩니다. 삭제 된 초록은 복구가 불가하오니 신중하게 선택 부탁드립니다.</li>
                    </ul>
                </div>
            </div>

            <div class="table-wrap scroll-x">
                <table class="cst-table">
                    <caption class="hide">초록 조회 상세</caption>
                    <colgroup>
                        <col style="width: 80px;">
                        <col style="width: 20%;">
                        <col>
                        <col style="width: 120px;">
                        <col style="width: 160px;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>초록 접수 번호</th>
                        <th>초록 제목</th>
                        <th>제출 상태</th>
                        <th>Preview / 수정 </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($abs_list as $key => $row)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $row->regnum ?? '' }}</td>
                        <td>{{ $row->title_kr ?? '' }}</td>

                        @if(($row->del ?? '') == 'Y')
                            <td>
                                <p>취소 완료</p>
                            </td>
                            <td></td>
                        @else
                            <td>
                                <p class="text-{{ ($row->status ?? 'N') == 'Y' ? 'red' : 'blue' }}">{{ ($row->status ?? 'N') == 'Y' ? '최종 제출' : '입력 진행중' }}</p>
                            </td>
                            <td>
                                @if(($row->status ?? 'N') == 'Y')
                                <div class="btn-wrap mt-0 text-center">
                                    <a href="{{ route('abstract.preview_pop',['work_code'=>$work_code,'sid'=>$row->sid]) }}" class="btn btn-small color-type4 btn-line w-100p call-popup" data-name="abs-preview" data-width="950" data-height="900">Preview</a>
                                </div>
                                @endif

                                @if($isAbsDue)
                                <div class="btn-wrap mt-0 text-center">
                                    <a href="{{ route('abstract',['work_code'=>$work_code,'sid'=>$row->sid]) }}" class="btn btn-small color-type2 w-50p">수정</a>
                                    <a href="javascript:;" class="btn btn-small color-delete w-50p abs-delete" data-sid="{{ $row->sid }}">삭제</a>
                                </div>
                                @endif

                                @if($isAbsGraceDue)
                                    <div class="btn-wrap mt-0 text-center">
                                        {{-- 예외등록 기간 체크 --}}
                                        @if($row->isGraceTarget() && $row->workshop->isAbsGraceDue() )
                                            <a href="{{ route('abstract',['work_code'=>$work_code,'sid'=>$row->sid]) }}" class="btn btn-small color-type2 w-50p">유예등록</a>
                                        @endif
                                    </div>
                                @endif

                            </td>
                        @endif
                    </tr>
                    @empty
                        <tr>
                           <td colspan="5">등록된 초록이 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </article>

@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('abstract.data',['work_code'=>$work_code]) }}';

        //삭제하기
        $(document).on('click', ".abs-delete", function() {
            const _sid = $(this).data('sid');

            if(confirm("초록 삭제 하시겠습니까? 삭제 후 초록 복구 되지 않습니다.")){
                callAjax(dataUrl, {
                    'case': 'abstract-delete',
                    'sid': _sid,
                });
            }else{
                return false;
            }
        });
    </script>
@endsection
