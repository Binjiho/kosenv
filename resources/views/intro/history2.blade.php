@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap type3">
                <ul class="sub-tab-menu">
                    <li ><a href="{{ route('intro.history',['tab'=>1]) }}">학회 연혁</a></li>
                    <li class="on"><a href="{{ route('intro.history',['tab'=>2]) }}">학술대회 연혁</a></li>
                </ul>
            </div>

            <div class="history-contents conf">
                <div class="year-rolling-wrap">
                    <a href="#n" class="btn btn-year-arrow btn-year-prev js-prev"><span class="hide">이전</span></a>
                    <div class="year-rolling js-year">
                        <a href="#n" class="current"><span>현재 ~ 2020</span></a>
                        <a href="#n"><span>2019 ~ 2010</span></a>
                        <a href="#n"><span>2009 ~ 2000</span></a>
                        <a href="#n"><span>1999 ~ 1990</span></a>
                        <a href="#n"><span>1989 ~ 1978</span></a>
                    </div>
                    <a href="#n" class="btn btn-year-arrow btn-year-next js-next"><span class="hide">다음</span></a>
                </div>

                <div class="history-rolling-wrap js-history-rolling">
                    <!-- s:현재 ~ 2020 -->
                    <div class="history-wrap js-history-wrap">
                        <div class="history-conbox">
                            <strong class="year">2024</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2024.6.27. ~ 6.28</p>
                                    <p class="con">
                                        제 9회 전문가그룹 학술대회 개최, 수원컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2024.11.6. ~ 11.8</p>
                                    <p class="con">
                                        국내학술대회 개최, 여수 엑스포컨벤션센터
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2023</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2023.6.27. ~ 6.28</p>
                                    <p class="con">
                                        제 8회 전문가그룹 학술대회 개최, 수원컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2023.10.31. ~ 11.3</p>
                                    <p class="con">
                                        국내학술대회 개최, 부산 BEXCO
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2022</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2022.6.31. ~ 7.1</p>
                                    <p class="con">
                                        제 7회 전문가그룹 학술대회 개최, 수원컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2022.11.8. ~ 11.11</p>
                                    <p class="con">
                                        국내학술대회 개최, 제주 신화월드
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2021</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2021.6.24. ~ 6.25</p>
                                    <p class="con">
                                        제 6회 전문가그룹 학술대회
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2021.11.3. ~ 11.5</p>
                                    <p class="con">
                                        국내학술대회 개최, 제주 신화월드
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2020</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2020.11.11. ~ 13</p>
                                    <p class="con">
                                        국내학술대회 개최, 제주 신화월드
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //e:현재 ~ 2020 -->

                    <!-- s:2019 ~ 2010 -->
                    <div class="history-wrap js-history-wrap">
                        <div class="history-conbox">
                            <strong class="year">2019</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2019.12.10. ~ 13</p>
                                    <p class="con">
                                        제5회 국제학술대회 및 국내학술대회 개최, 부산 벡스코
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2019.6.27. ~ 28</p>
                                    <p class="con">
                                        제5회 전문가그룹 학술대회, 아주대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2018</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2018.11.14.  ~ 16</p>
                                    <p class="con">
                                        40주년 기념 및 국내학술대회 개최, 광주 김대중컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2018.6.28. ~ 29</p>
                                    <p class="con">
                                        제4회 전문가그룹 학술대회, 건국대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2017</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2017.11.15. ~ 17</p>
                                    <p class="con">
                                        제4회 국제학술대회 개최 및 국내학술대회, 제주 ICC
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2017.6.22. ~ 23</p>
                                    <p class="con">
                                        제3회 전문가그룹 학술대회, 이화여자대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2016</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2017.11.16. ~ 18</p>
                                    <p class="con">
                                        국내학술대회 개최, 경주 화백컨벤션센터
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2015</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2015.10.28. ~ 30</p>
                                    <p class="con">
                                        제3회 국제학술대회 개최 및 국내학술대회, 부산 벡스코
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2015.6.25</p>
                                    <p class="con">
                                        제1회 전문가그룹 학술대회, 성균관대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2014</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2014.8.20. ~ 22</p>
                                    <p class="con">
                                        국내학술대회 개최, 광주 김대중컨벤션센터
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2013</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2013.6.11. ~ 13</p>
                                    <p class="con">
                                        제2회 국제학술대회 및 국내학술대회 개최, 서울 코엑스
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2012</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2012.8.22. ~ 24</p>
                                    <p class="con">
                                        국내학술대회 개최, 창원컨벤션센터
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2011</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2011.8.21. ~ 24</p>
                                    <p class="con">
                                        제1회 국제 학술대회 및 국내학술대회 개최, 부산 벡스코
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //e:2019 ~ 2010 -->

                    <!-- s:2009 ~ 2000 -->
                    <div class="history-wrap js-history-wrap">
                        <div class="history-conbox">
                            <strong class="year">2010</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2010.5.6. ~ 7</p>
                                    <p class="con">
                                        춘계학술발표회, 제주국제컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2010.12.2. ~ 3</p>
                                    <p class="con">
                                        추계학술발표회, 인천송도컨벤시아
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2009</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2009.4.30. ~ 5.1</p>
                                    <p class="con">
                                        춘계학술발표회, 창원컨벤션센터
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2009.11.5. ~ 6</p>
                                    <p class="con">
                                        추계학술발표회, 김대중컨벤션센터
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2008</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2008.5.1. ~ 2</p>
                                    <p class="con">
                                        춘계학술발표회, 울산대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2008.11.6. ~ 7</p>
                                    <p class="con">
                                        추계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2007</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2007.5.2. ~ 4</p>
                                    <p class="con">
                                        춘계학술발표회, 부산BEXCO (공동학술대회)
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2007.11.1. ~ 2</p>
                                    <p class="con">
                                        추계학술발표회, 강원대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2006</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2006.4.27. ~ 29</p>
                                    <p class="con">
                                        춘계학술발표회, KINTEX
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2006.11.2. ~ 3</p>
                                    <p class="con">
                                        추계학술발표회, 강릉대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2005</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2005.4.28. ~ 29</p>
                                    <p class="con">
                                        춘계학술발표회, 아주대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2005.11.3. ~ 5</p>
                                    <p class="con">
                                        추계학술발표회, 한서대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2004</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2004.4.29. ~ 5.1</p>
                                    <p class="con">
                                        춘계학술발표회, 경성대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2004.11.4. ~ 6</p>
                                    <p class="con">
                                        추계학술발표회, 전북대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2003</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2003.5.1. ~ 3</p>
                                    <p class="con">
                                        춘계학술발표회, 한국과학기술원
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2003.10.31. ~ 11.1</p>
                                    <p class="con">
                                        추계학술발표회, 명지대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2002</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2002.5.3. ~ 4</p>
                                    <p class="con">
                                        춘계학술발표회, 선문대학교 아산캠퍼스
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2002.10.31. ~ 11.2</p>
                                    <p class="con">
                                        추계학술발표회, 여수대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2001</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2001.5.11. ~ 12</p>
                                    <p class="con">
                                        춘계학술발표회, 이화여자대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2001.11.2. ~ 3</p>
                                    <p class="con">
                                        추계학술발표회, 포항공과대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">2000</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">2000.5.12. ~ 13</p>
                                    <p class="con">
                                        춘계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">2000.11.3. ~ 4</p>
                                    <p class="con">
                                        추계학술발표회, 관동대학교
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //e:2009 ~ 2000 -->

                    <!-- s:1999 ~ 1990 -->
                    <div class="history-wrap js-history-wrap">
                        <div class="history-conbox">
                            <strong class="year">1999</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1999.5.7. ~ 8</p>
                                    <p class="con">
                                        춘계학술발표회, 광운대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1999.11.5. ~ 6</p>
                                    <p class="con">
                                        추계학술발표회, 광주과학기술원
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1998</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1998.5.1. ~ 2</p>
                                    <p class="con">
                                        춘계학술발표회, 스위스그랜드 호텔
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1998.11.6. ~ 7</p>
                                    <p class="con">
                                        추계학술발표회, 공주대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1997</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1997.5.2. ~ 3</p>
                                    <p class="con">
                                        춘계학술발표회, 서울대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1997.11.7. ~ 8</p>
                                    <p class="con">
                                        추계학술발표회, 무주리조트
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1996</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1996.5.3. ~ 4</p>
                                    <p class="con">
                                        춘계학술발표회, 아주대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1996.11.1. ~ 2</p>
                                    <p class="con">
                                        추계학술발표회, 전남대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1995</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1995.5.19. ~ 20</p>
                                    <p class="con">
                                        춘계학술발표회, 인하대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1995.11.19. ~ 20</p>
                                    <p class="con">
                                        추계학술발표회, 영남대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1994</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1994.5.6. ~ 7</p>
                                    <p class="con">
                                        춘계학술발표회, 부산대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1994.11.18. ~ 19</p>
                                    <p class="con">
                                        추계학술발표회, 제주대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1993</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1993.5.7. ~ 8</p>
                                    <p class="con">
                                        춘계학술발표회, 경희대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1993.11.12. ~ 13</p>
                                    <p class="con">
                                        추계학술발표회, 대덕과학센타
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1992</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1992.5.1. ~ 2</p>
                                    <p class="con">
                                        춘계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1992.11.6. ~ 7</p>
                                    <p class="con">
                                        추계학술발표회, 경남대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1991</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1991.5.3. ~ 4</p>
                                    <p class="con">
                                        춘계학술발표회, 경기대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1991.11.1. ~ 2</p>
                                    <p class="con">
                                        추계학술발표회, 충남대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1990</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1990.5.11. ~ 12</p>
                                    <p class="con">
                                        춘계학술발표회, 서울산업대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1990.11.2. ~ 3</p>
                                    <p class="con">
                                        추계학술발표회, 강원대학교
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //e:1999 ~ 1990 -->

                    <!-- s:1989 ~ 1978 -->
                    <div class="history-wrap js-history-wrap">
                        <div class="history-conbox">
                            <strong class="year">1989</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1989.4.28. ~ 29</p>
                                    <p class="con">
                                        춘계학술발표회, 한국과학기술원
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1989.11.3. ~ 4</p>
                                    <p class="con">
                                        추계학술발표회, 조선대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1988</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1988.5.6. ~ 7</p>
                                    <p class="con">
                                        춘계학술발표회, 한국과학기술원
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1988.11.4. ~ 5</p>
                                    <p class="con">
                                        추계학술발표회, 연세원주캠퍼스
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1987</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1987.4.24. ~ 25</p>
                                    <p class="con">
                                        춘계학술발표회, 아주대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1987.11.6. ~ 7</p>
                                    <p class="con">
                                        추계학술발표회, 부산대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1986</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1986.4.25. ~ 26</p>
                                    <p class="con">
                                        춘계학술발표회, 건국대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1986.10.31. ~ 11.1</p>
                                    <p class="con">
                                        추계학술발표회, 충북대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1985</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1985.4.26. ~ 27</p>
                                    <p class="con">
                                        춘계학술발표회, 인하대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1985.11.1. ~ 2</p>
                                    <p class="con">
                                        추계학술발표회, 부산수산대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1984</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1984.5.12</p>
                                    <p class="con">
                                        춘계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1984.11.2. ~ 3</p>
                                    <p class="con">
                                        추계학술발표회, 영남대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1983</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1983.6.11</p>
                                    <p class="con">
                                        춘계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                                <li>
                                    <p class="date">1983.10.22</p>
                                    <p class="con">
                                        추계학술발표회, 전북대학교
                                    </p>
                                </li>
                            </ul>
                        </div>

                        <div class="history-conbox">
                            <strong class="year">1982</strong>
                            <ul class="history-con">
                                <li>
                                    <p class="date">1982.4.24</p>
                                    <p class="con">
                                        춘계학술발표회, 서울시립대학교
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- //e:1989 ~ 1978 -->
                </div>
            </div>
            <!-- //e:연혁 Type D -->
        </div>
    </article>

@endsection

@section('addScript')
@endsection
