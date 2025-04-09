<header id="header" class="js-header">
    <div class="header-wrap inner-layer">
        <h1 class="header-logo">
            <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}">헤더 로고</a>
        </h1>
        <ul class="util-menu">
            <li class="home"><a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}">Home</a></li>
            @if(thisAuth()->check())
                <li class="logout"><a href="javascript:logout();">Logout</a></li>
            @else
                <li class="login"><a href="{{ env('APP_URL') }}/auth/login">Login</a></li>
            @endif
                <li><a href="{{ env('APP_URL') }}/">대한환경공학회 홈페이지</a></li>
            @auth('admin')
                <li class="admin"><a href="{{ env('APP_URL') }}/admin">ADMIN</a></li>
            @endauth

        </ul>
        <a href="{{ env('APP_URL') }}/workshop/{{ $work_code }}" class="btn-home"><img src="/assets/image/common/ic_home.png" alt="Home"></a>
        <button type="button" class="btn btn-menu-open js-btn-menu-open"><span class="hide">메뉴 열기</span></button>
    </div>
    <nav id="gnb">
        <div class="m-gnb-header">
            <div class="util-wrap">
                <ul class="util-menu">
                    <li class="full"><a href="{{ env('APP_URL') }}/">대한환경공학회 홈페이지</a></li>
                </ul>
                <div class="dday-wrap">
                    <p>(Today : {{ date('Y.m.d') }}) </p>
                    <p class="dday">{{ $workshop->getDday($workshop->event_sdate) }}</p>
                </div>
                <ul class="util-menu">
                    @if(thisAuth()->check())
                        <li><a href="javascript:logout();">Logout</a></li>
                    @else
                        <li><a href="{{ env('APP_URL') }}/auth/info">SIGN UP</a></li>
                        <li><a href="{{ env('APP_URL') }}/auth/login">Login</a></li>
                    @endif
                    @auth('admin')
                        <li><a href="{{ env('APP_URL') }}/admin">ADMIN</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="gnb-wrap inner-layer">
            <ul class="gnb js-gnb">
            @foreach($work_menu['main'] as $key => $val)
                @if($val['continue']) @continue @endif
                <li>
                    <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{!! $val['name'] !!}</a>
                    @foreach($work_menu['sub'][$key] ?? [] as $sKey => $sVal)
                        @if($loop->first)
                            <ul>
                                @endif
                                <li><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}" >{!! $sVal['name'] !!}</a></li>
                                @if($loop->last)
                            </ul>
                        @endif
                    @endforeach
                </li>
            @endforeach
            </ul>
        </div>
        <button type="button" class="btn btn-menu-close js-btn-menu-close"><span class="hide">메뉴 닫기</span></button>
    </nav>
</header>