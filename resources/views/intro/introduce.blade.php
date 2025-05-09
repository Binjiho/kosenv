@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap mt-0">
                <h3 class="sub-tit">사무국 안내</h3>
            </div>
            <div class="contact-conbox">
                <ul class="map-icon">
                    <li><a href="#n"><img src="/assets/image/sub/img_kakaomap.png" alt="kakao map"></a></li>
                    <li><a href="#n"><img src="/assets/image/sub/img_navermap.png" alt="NAVER Map"></a></li>
                    <li><a href="#n"><img src="/assets/image/sub/img_googlemap.png" alt="Google Maps"></a></li>
                </ul>

                <div class="map-wrap">
                    <!-- * 카카오맵 - 지도퍼가기 -->
                    <!-- 1. 지도 노드 -->
                    <div id="daumRoughmapContainer1742454023627" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%;"></div>

                    <!--
                        2. 설치 스크립트
                        * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                    -->
                    <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

                    <!-- 3. 실행 스크립트 -->
                    <script charset="UTF-8">
                        new daum.roughmap.Lander({
                            "timestamp" : "1742454023627",
                            "key" : "2neq8",
                            "mapHeight" : "360"
                        }).render();
                    </script>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">대한환경공학회 사무국 안내</h4>
                </div>
                <ul class="map-info-list">
                    <li>
                        <img src="/assets/image/sub/ic_map_location.png" alt="">
                        <p>서울특별시 중구 청파로 464 101동 726호</p>
                    </li>
                    <li>
                        <img src="/assets/image/sub/ic_map_subway.png" alt="">
                        <p>충정로역(경기대입구) 4번 출구</p>
                    </li>
                    <li>
                        <img src="/assets/image/sub/ic_map_fax.png" alt="">
                        <p>02-383-9654</p>
                    </li>
                    <li>
                        <img src="/assets/image/sub/ic_map_tel.png" alt="">
                        <p>
                            <span>사무국 <a href="tel:02-383-9652" target="_blank">02-383-9652</a> <a href="mailto:kosenv@kosenv.or.kr" target="_blank">kosenv@kosenv.or.kr</a></span>
							<span>사무국(홍보) <a href="tel:02-383-9697" target="_blank">02-383-9697</a> <a href="mailto:social@kosenv.or.kr" target="_blank">social@kosenv.or.kr</a></span><br>

                            <span>편집국(국문지) <a href="tel:02-383-9653" target="_blank">02-383-9653</a> <a href="mailto:ksee@kosenv.or.kr" target="_blank">ksee@kosenv.or.kr</a></span>
                            <span>편집국(영문지) <a href="mailto:eer@kosenv.or.kr" target="_blank">eer@kosenv.or.kr</a></span>
                        </p>
                    </li>
                </ul>

                <div class="sub-tab-wrap type2">
                    <ul class="sub-tab-menu js-tab-menu">
                        <li class="on"><a href="#n">찾아오시는 길</a></li>
                        <li><a href="#n">사무국</a></li>
                    </ul>
                </div>

                <!-- s:찾아오시는 길 -->
                <div class="sub-tab-con js-tab-con" style="display: block;">
                    <ul class="contact-info">
                        <li>
                            <img src="/assets/image/sub/ic_map_train.png" alt="">
                            <div>
                                서부역 롯데마트 방향 800M 직진 후 한국경제신문사 맞은편
                            </div>
                        </li>
                        <li>
                            <img src="/assets/image/sub/ic_map_subway02.png" alt="">
                            <div>
                                <ul class="list-type list-type-dot">
                                    <li>
                                        2호선, 5호선 서부역 롯데마트 방향 800M 직진 후 한국경제신문사 맞은편
                                    </li>
                                    <li>
                                        출구방향으로 70M 직진 후 횡단보도 건너편 브라운스톤서울 726호▶ 1호선, 4호선 서울역 서부역 출구 (도보10분)
                                    </li>
                                    <li>
                                        서부역 방향으로 나오신 후 한국경제신문사 방향 이동 후 맞은편
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <img src="/assets/image/sub/ic_map_bus.png" alt="">
                            <div>
                                <strong class="tit">한국경제신문사</strong>
                                <p>
                                    [공항] 6015(LW컨벤션→인천공항) <br>
                                    [마을] 06(서부역→LW컨벤션) <br>
                                    [간선] 603 [지선] 7011, 7013, 7017
                                </p>

                                <strong class="tit">서울역서브</strong>
                                <p>
                                    [간선] 163, 261, 262, 463, 604
                                </p>

                                <strong class="tit">종근당</strong>
                                <p>
                                    [간선] 62, 172, 472, 603 [지선] 7011, 7013, 7017 <br>
                                    [광역] 1000, 1100, 1101, 1200, 1300, 1301, 1400, 1500, 6118
                                </p>

                                <strong class="tit">국민권익위원회</strong>
                                <p>
                                    [간선] 101, 702, 703, 705, 752 <br>
                                    [지선] 7019, 7021, 7024
                                </p>

                                <strong class="tit">서대문경찰서</strong>
                                <p>
                                    [광역] 1000, 9710, 9701, 9703, 9709, 9714
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- //e:찾아오시는 길 -->

                <!-- s:사무국 -->
                <div class="sub-tab-con js-tab-con">
                    <ul class="box-list">
                        <li>
                            <span class="tit">팀장</span>
                            <div class="text-wrap">
                                <strong>류 미</strong>
                                <ul class="list-type list-type-dot">
                                    <li>
                                        사무행정, 학술연구용역
                                    </li>
                                    <li>
                                        <a href="tel:02-383-9652" target="_blank">02-383-9652</a>
                                    </li>
                                    <li>
                                        <a href="mailto:kosenv@kosenv.or.kr" target="_blank">kosenv@kosenv.or.kr</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span class="tit">매니저</span>
                            <div class="text-wrap">
                                <strong>양서진</strong>
                                <ul class="list-type list-type-dot">
                                    <li>
                                        국문학회지, 사무행정
                                    </li>
                                    <li>
                                        <a href="tel:02-383-9653" target="_blank">02-383-9653</a>
                                    </li>
                                    <li>
                                        <a href="mailto:ksee@kosenv.or.kr" target="_blank">ksee@kosenv.or.kr</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span class="tit">매니저</span>
                            <div class="text-wrap">
                                <strong>임성현</strong>
                                <ul class="list-type list-type-dot">
                                    <li>
                                        사무행정, 홍보
                                    </li>
                                    <li>
                                        <a href="tel:02-383-9697" target="_blank">02-383-9697</a>
                                    </li>
                                    <li>
                                        <a href="mailto:social@kosenv.or.kr" target="_blank">social@kosenv.or.kr</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- //e:사무국 -->
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
