@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap mt-0">
                <h3 class="sub-tit">CI 소개</h3>
            </div>
            <div class="img-wrap">
                <picture>
                    <source srcset="/assets/image/sub/img_ci_m.png" media="(max-width: 768px)">
                    <img src="/assets/image/sub/img_ci.png" alt="하늘(구름) : 환경의 상징 + 환경(지구) : 학회교류의장 상징 + 땅(산맥) : 산맥으로 둘러싼 대한민국 상징. 구름 : 환경의 조화 + 새 : 미래 길잡이 상징. 산책 : 환경의 조화 + 손 : 정보교환 및 친목상징">
                </picture>
            </div>
            <div class="ci-list">
                <li>
                    <strong class="ci-tit">전체적 컨셉</strong>
                    <div class="text-wrap">
                        <strong>지구형태</strong>
                        <p>
                            환경공학회 학술 교류의 장을 형상화미
                        </p>
                    </div>
                </li>
                <li>
                    <strong class="ci-tit">부분적 컨셉</strong>
                    <div class="text-wrap">
                        <strong>원을 그리는 손모양의 새</strong>
                        <p>
                            환경공학의 발전과 회원간의 정보교환 및 친목 의미
                        </p>
                    </div>
                </li>
            </div>

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">로고 다운로드</h3>
            </div>
            <div class="logo-list">
                <li>
                    <a href="/assets/file/logo.ai" target="_blank">
                        <div class="img">
                            <img src="/assets/image/sub/img_logo01.png" alt="KSEE 사단법인 대한환경공학회. KOREAN SOCIETY OF ENVIRONMENTAL ENGINEEERS.">
                        </div>
                        <div class="tit">
                            <u>대한환경공학회 로고 AI파일 다운로드</u> <img src="/assets/image/icon/ic_download.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/assets/file/emblem.ai" target="_blank">
                        <div class="img">
                            <img src="/assets/image/sub/img_logo02.png" alt="KOREAN SOCIETY OF ENVIRONMENTAL ENGINEEERS. KSEE. SINCE 1978">
                        </div>
                        <div class="tit">
                            <u>대한환경공학회 엠블럼 AI파일 다운로드</u> <img src="/assets/image/icon/ic_download.png" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/assets/file/logo.png" target="_blank">
                        <div class="img">
                            <img src="/assets/image/sub/img_logo03.png" alt="KSEE">
                        </div>
                        <div class="tit">
                            <u>대한환경공학회 로고 PNG 파일 다운로드</u> <img src="/assets/image/icon/ic_download.png" alt="">
                        </div>
                    </a>
                </li>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
