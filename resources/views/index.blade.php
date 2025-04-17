@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <section id="container">
        <article class="main-visual js-main-visual">
            <div class="main-visual-con main-visual-con01">
                <div class="main-visual-text inner-layer">
                    <h2 class="main-visual-tit font-paper">
                        회원과 <span>함께,</span> 빛나는 <br>
                        <strong>대한환경공학회</strong>
                    </h2>
                    <p>
                        환경공학 학문의 발전과, 환경공학기술자의 지위향상, 환경공학기술의 개발 및 지도, <br>
                        환경보전대책에 관한 조사연구 및 건의, 회원상호간의 친목 및 협조를 목적으로 하고 있습니다.
                    </p>
                </div>
            </div>
            <div class="main-visual-con main-visual-con02">
                <div class="main-visual-text inner-layer">
                    <h2 class="main-visual-tit font-paper">
                        회원과 <span>함께,</span> 빛나는 <br>
                        <strong>대한환경공학회</strong>
                    </h2>
                    <p>
                        환경공학 학문의 발전과, 환경공학기술자의 지위향상, 환경공학기술의 개발 및 지도, <br>
                        환경보전대책에 관한 조사연구 및 건의, 회원상호간의 친목 및 협조를 목적으로 하고 있습니다.
                    </p>
                </div>
            </div>
        </article>

        <article class="main-contents inner-layer">
            <ul class="main-menu-list">
                <li>
                    <a href="{{ route('joinInfo') }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu01.png" alt=""></span>
                        <strong class="tit">입회안내</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mypage.fee') }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu02.png" alt=""></span>
                        <strong class="tit">회비납부</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('board',['code'=>'monthly-magazine']) }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu03.png" alt=""></span>
                        <strong class="tit">월간지</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('journal.integrationSearch') }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu04.png" alt=""></span>
                        <strong class="tit">저널검색</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('event.domestic') }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu05.png" alt=""></span>
                        <strong class="tit">학술대회</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('board',['code'=>'offer']) }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu06.png" alt=""></span>
                        <strong class="tit">구인구직</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('board',['code'=>'mems']) }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu07.png" alt=""></span>
                        <strong class="tit">회원동정</strong>
                    </a>
                </li>
                <li>
                    <a href="{{ route('board',['code'=>'event-schedule']) }}">
                        <span class="icon"><img src="/assets/image/main/ic_main_menu08.png" alt=""></span>
                        <strong class="tit">행사안내</strong>
                    </a>
                </li>
            </ul>
        </article>

        <article class="main-contents">
            <div class="inner-layer">
                <div class="main-conbox main-board-conbox">
                    <div class="main-tit-wrap">
                        <h3 class="main-tit">학회소식</h3>
                        <a href="{{ route('board',['code'=>'notice']) }}" class="btn btn-more"><span class="hide">더보기</span></a>
                        <ul class="main-board-cate">
                            <li class="{{ (request()->bcode ?? '') == '' ? 'on' : '' }}">
                                <a href="{{ route('main') }}">전체</a>
                            </li>
                            <li class="{{ (request()->bcode ?? '') == 'notice' ? 'on' : '' }}">
                                <a href="{{ route('main',['bcode'=>'notice']) }}">공지사항</a>
                            </li>
                            <li class="{{ (request()->bcode ?? '') == 'eco' ? 'on' : '' }}">
                                <a href="{{ route('main',['bcode'=>'eco']) }}">환경관련행사</a>
                            </li>
                            <li class="{{ (request()->bcode ?? '') == 'mems' ? 'on' : '' }}">
                                <a href="{{ route('main',['bcode'=>'mems']) }}">회원동정</a>
                            </li>
                            <li class="{{ (request()->bcode ?? '') == 'monthly-magazine' ? 'on' : '' }}">
                                <a href="{{ route('main',['bcode'=>'monthly-magazine']) }}">월간지</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="main-board-list">
                        @php
                            $cate = [
                                'notice'=>['cate'=> 'cate01', 'name'=>'공지사항'],
                                'eco'=>['cate'=> 'cate02', 'name'=>'환경관련행사'],
                                'mems'=>['cate'=> 'cate03', 'name'=>'회원동정'],
                                'monthly-magazine'=>['cate'=> 'cate04', 'name'=>'월간지'],
                            ];
                        @endphp

                        @forelse($notice_list as $row)
                        <li>
                            @if($row->code == 'monthly-magazine')
                                <a href="{{ !empty($row->link_url) ? $row->link_url : 'javascript:;' }}" {{ !empty($row->link_url) ? 'target="_blank"' : '' }} >
                            @else
                                <a href="{{ route('board.view', ['code' => $row->code, 'sid' => $row->sid]) }}">
                            @endif
                                <span class="cate {{ $cate[$row->code]['cate'] }}">{{ $cate[$row->code]['name'] }}</span>
                                <span class="subject ellipsis">
                                    {{ $row->subject ?? '' }}
                                </span>
                                <span class="date">
                                    {{ $row->created_at->format('Y.m.d') ?? '' }}
                                </span>
                            </a>
                        </li>
                        @empty
                            <li>
                            </li>
                        @endforelse
                    </ul>
                </div>

                {{--  포토갤러리  --}}
                <div class="main-conbox main-gall-conbox">
                    <div class="main-tit-wrap">
                        <h3 class="main-tit">포토갤러리</h3>
                    </div>
                    @if(!empty($photo))
                    <div class="img-wrap">
                        <a href="{{ route('board.view', ['code' => 'photo', 'sid' => $photo->sid]) }}">
                            <img src="{{ empty($photo->thumbnail_realfile) ? '/html/bbs/vod/assets//image/no_image.png' : asset($photo->thumbnail_realfile) }}" alt="">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </article>

        <article class="main-contents">
            <div class="inner-layer cf">
                <div class="select-year-wrap">
                    <div class="month-wrap">
                        <button type="button" class="btn-month js-btn-tab-drop">1</button>
                        <ul class="month ">
                            <li class="{{ (request()->month ?? date('m') ) == '1' ? 'on' : '' }}" data-month="1"><a href="javascript:;">1</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '2' ? 'on' : '' }}" data-month="2"><a href="javascript:;">2</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '3' ? 'on' : '' }}" data-month="3"><a href="javascript:;">3</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '4' ? 'on' : '' }}" data-month="4"><a href="javascript:;">4</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '5' ? 'on' : '' }}" data-month="5"><a href="javascript:;">5</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '6' ? 'on' : '' }}" data-month="6"><a href="javascript:;">6</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '7' ? 'on' : '' }}" data-month="7"><a href="javascript:;">7</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '8' ? 'on' : '' }}" data-month="8"><a href="javascript:;">8</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '9' ? 'on' : '' }}" data-month="9"><a href="javascript:;">9</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '10' ? 'on' : '' }}" data-month="10"><a href="javascript:;">10</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '11' ? 'on' : '' }}" data-month="11"><a href="javascript:;">11</a></li>
                            <li class="{{ (request()->month ?? date('m') ) == '12' ? 'on' : '' }}" data-month="12"><a href="javascript:;">12</a></li>
                        </ul>
                    </div>
                    <div class="select-year">
                        <select name="year" id="year">
                            <option value="2025" {{ (request()->year ?? date('Y') ) == '2025' ? 'selected' : '' }}>2025</option>
                            <option value="2024" {{ (request()->year ?? date('Y') ) == '2024' ? 'selected' : '' }}>2024</option>
                            <option value="2023" {{ (request()->year ?? date('Y') ) == '2023' ? 'selected' : '' }}>2023</option>
                        </select>
                    </div>
                </div>
                <div class="main-ev-wrap">
                    <div class="main-tit-wrap">
                        <a href="{{ route('board',['code'=>'event-schedule']) }}" class="btn btn-more"><span class="hide">더보기</span></a>
                        <h3 class="main-tit">학회 일정 안내</h3>
                        <p>
                            예정된 학회 일정을 안내 합니다. <br>
                            많은 관심과 참여 부탁 드립니다.
                        </p>
                    </div>
                    <div class="main-ev-rolling js-ev-rolling">
                        @forelse($event_list as $row)
                        <div class="main-ev-con">
                            <a href="{{ route('board.view', ['code' => 'event-schedule', 'sid' => $row->sid]) }}">
                                <span class="month">{{ date('m', strtotime($row->event_sDate)) }}월</span>
                                <strong class="tit ellipsis2"><span>{{ $row->subject }}</span></strong>
                                <span class="place ellipsis2">{{ $row->place }}</span>
                                <p class="date text-right">{{ $row->created_at->format('Y.m.d') }}</p>
                            </a>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </article>

        <article class="main-contents">
            <ul class="main-quick-menu inner-layer">
                <li>
                    <a href="/domestic">
                        <span class="tit">2024년도 <br>국내학술대회</span>
                        <img src="/assets/image/main/img_main_quick01.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="https://submit.kosenv.or.kr/" target="_blank">
                        <span class="tit">국문 논문 투고</span>
                        <img src="/assets/image/main/img_main_quick02.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="https://www.editorialmanager.com/eer/default2.aspx" target="_blank">
                        <span class="tit">영문 논문 투고</span>
                        <img src="/assets/image/main/img_main_quick03.png" alt="">
                    </a>
                </li>
            </ul>
        </article>

        <article class="main-contents inner-layer">
            <div class="main-tit-wrap">
                <h3 class="main-tit">학회 관련 사이트</h3>
            </div>
            <ul class="related-list">
                <li>
                    <a href="https://www.eeer.org/" target="_blank">
                            <span class="logo">
                                <img src="/assets/image/main/img_related_logo01.png" alt="Environmental Engineering Research">
                            </span>
                    </a>
                </li>
                <li>
                    <a href="https://www.jksee.or.kr/" target="_blank">
                            <span class="logo">
                                <img src="/assets/image/main/img_related_logo02.png" alt="Journal of Korean Society of Environmental Engineering">
                            </span>
                    </a>
                </li>
                <li>
                    <a href="https://kofst.or.kr/main.bit?sys_type=0000" target="_blank">
                            <span class="logo">
                                <img src="/assets/image/main/img_related_logo03.png" alt="KOFST">
                            </span>
                    </a>
                </li>
                <li>
                    <a href="https://me.go.kr/home/web/main.do" target="_blank">
                            <span class="logo">
                                <img src="/assets/image/main/img_related_logo04.png" alt="환경부">
                            </span>
                    </a>
                </li>
                <li>
                    <a href="https://www.nts.go.kr/" target="_blank">
                            <span class="logo">
                                <img src="/assets/image/main/img_related_logo05.png" alt="국세청">
                            </span>
                    </a>
                </li>
            </ul>
        </article>

        <article class="sponsor-wrap">
            <div class="sponsor-rolling js-sponsor-rolling inner-layer">
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_posco.png" alt="posco 포스코이앤씨"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_hyundai.png" alt="현대건설"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_taesung.png" alt="태성종합기술"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_daewoo.png" alt="대우건설"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_ilto.png" alt="일토씨엔엠"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_echorbit.png" alt="ECORBIT 에코비트"></a>

                <!-- s:repeat -->
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_posco.png" alt="posco 포스코이앤씨"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_hyundai.png" alt="현대건설"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_taesung.png" alt="태성종합기술"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_daewoo.png" alt="대우건설"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_ilto.png" alt="일토씨엔엠"></a>
                <a href="#n" target="_blank"><img src="/assets/image/main/img_sponsor_echorbit.png" alt="ECORBIT 에코비트"></a>
                <!-- //e:repeat -->
            </div>
        </article>
    </section>
@endsection

@section('addScript')
    <script>
        $(document).on('click', '.month li', function() {
            $('.month li').removeClass('on');
            // 클릭된 항목에 'on' 클래스 추가
            $(this).addClass('on');

            const _month = $(this).data('month');
            const _year = $("#year").val();
            location.href="/?month="+_month+"&year="+_year;
        });

        $(document).on('change', '#year', function() {
            const _month = $(".month li.on").data('month');
            const _year = $("#year").val();
            location.href="/?month="+_month+"&year="+_year;
        });
    </script>


    @if(!empty($boardPopupList))
        @include('common.board.popup.multi_pop', ['boardPopupList' => $boardPopupList])
    @endif
@endsection
