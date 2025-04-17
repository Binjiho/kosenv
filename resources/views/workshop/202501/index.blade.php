@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
    
@endsection

@section('contents')
    <div class="main-content main-content01">
        <div class="inner-layer">
            <div class="main-title">
                <p class="font-Gmar sub-title">2025 대한환경공학회 </p>
                <h2 class="font-Gmar">제10회 전문가그룹 학술대회 </h2>
                <div class="dday-wrap">
                    <div class="text font-Mont">
                        <span>TODAY</span>
                        <p>{{ date('Y.m.d') }}</p>
                    </div>
                    <p class="day font-Mont">{{ $workshop->getDday($workshop->event_sdate) }}</p>
                </div>
            </div>
            <div class="main-title-date">
                <dl>
                    <dt>일시</dt>
                    <dd>{{ $workshop->eventMainDate() }}</dd>
                </dl>
                <dl>
                    <dt>장소</dt>
                    <dd>KAIST 창의학습관 (E11)</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="main-content main-content02">
        <div class="inner-layer">
            <ul class="main-quick-menu">
                <li>
                    <a href="/workshop/202501/invite">
                        <img src="/target/202501/assets/image/main/ic_main_quick01.png" alt="">
                        <p>행사안내</p>
                    </a>
                </li>
                <li>
                    <a href="/workshop/202501/program">
                        <img src="/target/202501/assets/image/main/ic_main_quick02.png" alt="">
                        <p>프로그램</p>
                    </a>
                </li>
                <li>
                    <a href="/workshop/202501/registration/info">
                        <img src="/target/202501/assets/image/main/ic_main_quick03.png" alt="">
                        <p>사전등록 안내</p>
                    </a>
                </li>
                <li>
                    <a href="/workshop/202501/abstract/info">
                        <img src="/target/202501/assets/image/main/ic_main_quick04.png" alt="">
                        <p>초록접수 안내</p>
                    </a>
                </li>
                <li>
                    <a href="/workshop/202501/support/info">
                        <img src="/target/202501/assets/image/main/ic_main_quick05.png" alt="">
                        <p>후원안내</p>
                    </a>
                </li>
            </ul>
            <div class="main-quick-link">
                <a href="/workshop/202501/registration">
                    <div class="ico">
                        <img src="/target/202501/assets/image/main/ic_main_link01.png" alt="">
                    </div>
                    <p>사전등록 바로가기</p>
                </a>
                <a href="/workshop/202501/registration/search">
                    <div class="ico">
                        <img src="/target/202501/assets/image/main/ic_main_link02.png" alt="">
                    </div>
                    <p>사전등록 조회 및 영수증 출력</p>
                </a>
                <a href="/workshop/202501/abstract/check">
                    <div class="ico">
                        <img src="/target/202501/assets/image/main/ic_main_link03.png" alt="">
                    </div>
                    <p>초록접수 바로가기</p>
                </a>
            </div>
        </div>
    </div>
    <div class="main-content main-content03">
        <div class="inner-layer notice-wrap">
            <div class="notice-left">
                <h4><img src="/target/202501/assets/image/main/ic_main_tit01.png" alt="">IMPORTANT DATES</h4>
                <ul class="notice-list">
                    <li>
                        <p><span>초록접수</span></p>
                        <p class="date"><span>{{ $workshop->absDate() }}</span></p>
                    </li>
                    <li>
                        <p><span>사전등록</span></p>
                        <p class="date"><span>{{ $workshop->regDate() }}</span></p>
                    </li>
                    <li>
                        <p><span>후원신청</span></p>
                        <p class="date"><span>{{ $workshop->supportDate() }}</span></p>
                    </li>
                </ul>
            </div>
            <div class="notice-right">
                <div class="title-wrap">
                    <h4><img src="/target/202501/assets/image/main/ic_main_tit02.png" alt="">공지사항</h4>
                    {{-- WorkshopCode--}}
                    <a href="{{ route('board',['code'=>'workshop-202501', 'work_code'=>'202501']) }}" class="view">더보기 <img src="/target/202501/assets/image/main/ic_main_plus.png" alt=""></a>
                </div>
                <ul class="notice-list">
                    @forelse($noticeList as $val)
                    <li>
                        {{-- WorkshopCode--}}
                        <a href="{{ route('board.view',['code'=>'workshop-202501', 'work_code'=>'202501', 'sid'=>$val->sid]) }}">
                            <p class="ellipsis"><span>{{ $val->subject ?? '' }}</span></p>
                            <p class="date">{{ $val->created_at->format('Y.m.d') }}</p>
                        </a>
                    </li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    @foreach($boardPopupList as $row /* 게시판 팝업 */)
        @include('common.board.popup.template' . $row->popups->popup_skin, ['board' => $row, 'popup' => $row->popups])
    @endforeach

    <script>
        function setCookie24(name, value, expiredays) {
            var todayDate = new Date();

            todayDate.setDate(todayDate.getDate() + expiredays);

            document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
        }

        $(document).on('click', '.btn-pop-close', function () {
            $(this).closest('.popup-wrap').remove();
        });

        $(document).on('click', '.btn-pop-today-close', function () {
            const layer = $(this).closest('.popup-wrap');

            setCookie24(layer.attr('id'), 'done', 1);

            layer.remove();
        });
    </script>
@endsection
