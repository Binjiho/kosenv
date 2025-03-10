@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:회비납부 -->
            <!-- 일반회원 -->
            @if(($user->gubun ?? '') == 'N')
            <div class="bg-box bg-white">
                <ul class="list-type list-type-dot green">
                    <li>회원 등급 : {{ $userConfig['gubun'][ $user->gubun ?? '' ] }} - {{ $userConfig['grade'][ $user->gubun ?? '' ][$user->grade ?? ''] }}</li>
                    <li>당해연도 회비 납부 기간 : {{ date('Y') }}.01.01 ~ {{ date('Y') }}.12.31</li>
                    @if(($user->grade ?? '') == 'A')
                        <li>차기연도 회비 납부일 : {{ date('Y',strtotime('+1 year')) }}.01.01 ~ {{ date('Y',strtotime('+1 year')) }}.12.31</li>
                    @else
                        <li>차기연도 회비 납부일 : </li>
                    @endif
                </ul>
                <p class="help-text text-red mt-10">* 연회비 또는 종신회비 납부 요청 드립니다. 종신회비 납부 시 당해연도 연회비부터는 납부하지 않으셔도 됩니다.</p>
            </div>
            @endif
            @if(($user->gubun ?? '') == 'S')
            <!-- 특별회원 -->
            <div class="bg-box bg-white">
                <ul class="list-type list-type-dot green">
                    <li>회원 등급 : 특별회원  - {{ $userConfig['grade'][ $user->gubun ?? '' ][$user->grade ?? ''] }}</li>
                    <li>당해연도 회비 납부 기간 : {{ date('Y') }}.01.01 ~ {{ date('Y') }}.12.31</li>
                    <li>차기연도 회비 납부일 : {{ date('Y',strtotime('+1 year')) }}.01.01 ~ {{ date('Y',strtotime('+1 year')) }}.12.31</li>
                </ul>
            </div>
            @endif
            @if(($user->gubun ?? '') == 'G')
            <!-- 단헤회원 -->
            <div class="bg-box bg-white">
                <ul class="list-type list-type-dot green">
                    <li>회원 등급 : 단체회원</li>
                    <li>당해연도 회비 납부 기간 : {{ date('Y') }}.01.01 ~ {{ date('Y') }}.12.31</li>
                    <li>차기연도 회비 납부일 : {{ date('Y',strtotime('+1 year')) }}.01.01 ~ {{ date('Y',strtotime('+1 year')) }}.12.31</li>
                </ul>
            </div>
            @endif

            <div class="table-wrap scroll-x touch-help mt-10">
                <table class="cst-table list-table">
                    <caption class="hide">회비 납부 목록</caption>
                    <colgroup>
                        @if(($user->gubun ?? '') == 'N')
                        <col style="width: 5%;">
                        @endif
                        <col style="width: 7%;">
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                        <col>
                        <col style="width: 10%;">

                        <col style="width: 14%;">
                        <col style="width: 14%;">
                        <col style="width: 12%;">
                    </colgroup>
                    <thead>
                    <tr>
                        @if(($user->gubun ?? '') == 'N')
                            <th scope="col">선택</th>
                        @endif
                        <th scope="col">연도</th>
                        <th scope="col">회비 구분</th>
                        <th scope="col">회비 금액</th>
                        <th scope="col">납부 일자</th>
                        <th scope="col">납부 방법</th>

                        <th scope="col">회비 납부 / 납부 상태</th>
                        <th scope="col">거래명세서</th>
                        <th scope="col">영수증</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($list as $row)
                        @if(($user->gubun ?? '') == 'N')
                            <tr data-sid="{{ $row->sid ?? 0 }}">
                                <td>
                                    <input type="checkbox" value="{{ $row->sid ?? 0 }}" {{ ($row->category ?? '') == 'C' ? 'disabled' : '' }}>
                                </td>
                                <td>{{ $row->year ?? 0 }}</td>
                                <td>{{ $feeConfig['category'][$row->category ?? ''] ?? '' }}</td>
                                <td>{{ number_format($row->price ?? 0) }}</td>
                                <td>
                                    @if(!empty($row->payment_date) && isValidTimestamp($row->payment_date))
                                        {{ $row->payment_date ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($row->payment_method))
                                        {{ $feeConfig['payment_method'][$row->payment_method ?? ''] ?? '' }}
                                    @endif
                                </td>

                                @if($row->year >= date('Y'))
                                    {{-- 차기연도 연회비 셋팅은 관리자 > 회비 관리에서 {당해연도}.12.01부터 회비 셋팅 버튼 클릭 가능합니다. 단 차기연도 회비는 셋팅 되나 납부는 1월 1일 00시부터 가능--}}
                                    @if($row->year > date('Y'))
                                        <td>
                                            <strong class="state text-red">해당없음</strong>
                                        </td>
                                    @else
                                        {{-- 일반회원 – 정회원이 당해연도 종신회비 완납 시 당해연도 연회비 납부 버튼 노출 X + 해당없음으로 자동 변경 --}}
                                        @if(($row->category ?? '') == 'B' && ($user->grade ?? '') == 'B')
                                            <td>
                                                <strong class="state text-red">해당없음</strong>
                                            </td>
                                        @else
                                            <td>
                                                <strong class="state text-{{ ($row->payment_status ?? '') == 'Y' ? 'blue' : 'red' }}">{{ ($row->payment_status ?? '') == 'Y' ? '완납' : '미납' }}</strong>
                                                @if(($row->payment_status ?? '') == 'N')
                                                <a href="{{ route('mypage.fee.upsert',['sid'=>$row->sid ?? 0]) }}" class="btn btn-small color-type6 call-custom-popup" data-popup_name="pay-pop" data-width="900" data-height="700">{{ $feeConfig['category'][$row->category ?? ''] ?? '' }} 납부</a>
                                                @endif
                                            </td>
                                        @endif
                                    @endif
                                @else
                                    {{-- 해가 지난 연회비는 납부 가능 --}}
                                    @if(($row->category ?? '') == 'B')
                                        <td>
                                            <strong class="state text-{{ ($row->payment_status ?? '') == 'Y' ? 'blue' : 'red' }}">{{ ($row->payment_status ?? '') == 'Y' ? '완납' : '미납' }}</strong>
                                            @if(($row->payment_status ?? '') == 'N')
                                                <a href="{{ route('mypage.fee.upsert',['sid'=>$row->sid ?? 0]) }}" class="btn btn-small color-type6 call-custom-popup" data-popup_name="pay-pop" data-width="900" data-height="700">{{ $feeConfig['category'][$row->category ?? ''] ?? '' }} 납부</a>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            <strong class="state text-red">해당없음</strong>
                                        </td>
                                    @endif
                                @endif

                                <td>
                                    @if(($row->payment_status ?? '') == 'Y')
                                    <a href="{{ route('mypage.fee.transaction',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type8 call-popup" data-popup_name="transaction-pop" data-width="600" data-height="700">거래명세서</a>
                                    @endif
                                </td>
                                <td>
                                    @if(($row->payment_status ?? '') == 'Y')
                                    <a href="{{ route('mypage.fee.receipt',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="550">영수증</a>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $row->year ?? 0 }}</td>
                                <td>{{ $feeConfig['category'][$row->category ?? ''] ?? '' }}</td>
                                <td>{{ number_format($row->price ?? 0) }}</td>
                                <td>
                                    @if(!empty($row->payment_date) && isValidTimestamp($row->payment_date))
                                        {{ $row->payment_date ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($row->payment_method))
                                        {{ $feeConfig['payment_method'][$row->payment_method ?? ''] ?? '' }}
                                    @endif
                                </td>

                                {{-- 차기연도 연회비 셋팅은 관리자 > 회비 관리에서 {당해연도}.12.01부터 회비 셋팅 버튼 클릭 가능합니다. 단 차기연도 회비는 셋팅 되나 납부는 1월 1일 00시부터 가능--}}
                                @if($row->year > date('Y'))
                                    <td>
                                        <strong class="state text-red">해당없음</strong>
                                    </td>
                                @else
                                    {{-- 해가 지난 연회비는 납부 가능 --}}
                                    <td>
                                        <strong class="state text-{{ ($row->payment_status ?? '') == 'Y' ? 'blue' : 'red' }}">{{ ($row->payment_status ?? '') == 'Y' ? '완납' : '미납' }}</strong>
                                        @if(($row->payment_status ?? '') == 'N')
                                            <a href="{{ route('mypage.fee.upsert',['sid'=>$row->sid ?? 0]) }}" class="btn btn-small color-type6 call-popup" data-popup_name="pay-pop" data-width="900" data-height="700">{{ $feeConfig['category'][$row->category ?? ''] ?? '' }} 납부</a>
                                        @endif
                                    </td>
                                @endif

                                <td>
                                    @if(($row->payment_status ?? '') == 'Y')
                                        <a href="{{ route('mypage.fee.transaction',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type8 call-popup" data-popup_name="transaction-pop" data-width="600" data-height="700">거래명세서</a>
                                    @endif
                                </td>
                                <td>
                                    @if(($row->payment_status ?? '') == 'Y')
                                        <a href="{{ route('mypage.fee.receipt',['tid'=>$row->tid ?? '']) }}" class="btn btn-small color-type9 call-popup" data-popup_name="receipt-pop" data-width="600" data-height="550">영수증</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="8">회비 내역이 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- //e:회비납부-->

        </div>
    </article>
@endsection

@section('addScript')
    <script>
        $(document).on('click', ".call-custom-popup", function(e){
            e.preventDefault(); // 기본 이벤트 막기

            let _url = $(this).attr('href');

            let sidArr = [];

            // 체크된 체크박스 sid값 배열에 담기
            $('input[type=checkbox]:checked').each(function () {
                let sid = $(this).closest('tr').data('sid') ?? 0;
                if (sid > 0) {
                    sidArr.push(sid);
                }
            });

            if (sidArr.length > 0) {
                // 기존 URL에서 sid 파라미터 제거
                _url = $(this).attr('href').split('?')[0];

                // sid 배열을 쿼리스트링으로 추가
                _url += '?sid=' + sidArr.join(',');

                // href에 적용
                $(this).attr('href', _url);
            }

            // console.log(sidArr);
            // console.log(_url);

            const popupHeight = isEmpty($(this).data('height')) ? 700 : $(this).data('height');
            const popupWidth = isEmpty($(this).data('width')) ? 500 : $(this).data('width');
            const popName = isEmpty($(this).data('popup_name')) ? 'popup' : $(this).data('popup_name');
            const popupY = (window.screen.height / 2) - (popupHeight / 2);
            const popupX = (window.screen.width / 2) - (popupWidth / 2);

            window.open(_url, popName, 'status=no, height=' + popupHeight + ', width=' + popupWidth + ', left=' + popupX + ', top=' + popupY);
        });

    </script>
@endsection
