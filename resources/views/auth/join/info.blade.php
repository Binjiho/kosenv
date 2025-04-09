@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap type3">
                <ul class="sub-tab-menu js-tab-menu">
                    <li class="on"><a href="#n">일반회원</a></li>
                    <li><a href="#n">특별회원</a></li>
                    <li><a href="#n">단체회원</a></li>
                </ul>
            </div>

            <!-- 일반회원 -->
            <div class="signup-wrap sub-tab-con js-tab-con" style="display: block;">
                <div class="bg-box">
                    <strong>일반회원</strong> 가입
                </div>
                <div class="sub-tit-wrap mt-0">
                    <h3 class="sub-tit">회원의 종류</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>정회원 / 종신회원</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">가입혜택</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>발간물
                        <ul class="list-type list-type-bar">
                            <li>대한환경공학회지’ (국문지, 월간 발행), 'EER' (영문지, 격월 발행) 학회지 웹북구독 </li>
                        </ul>
                    </li>
                    <li>행사
                        <ul class="list-type list-type-bar">
                            <li>학술대회 등 행사 참가시 등록비 할인</li>
                            <li>학회 주최행사에 참가 기회부여</li>
                        </ul>
                    </li>
                    <li>혜택
                        <ul class="list-type list-type-bar">
                            <li>회원증 발급</li>
                            <li>학회 회원동정 홈페이지 게재</li>
                            <li>학회 포상 기회 부여</li>
                            <li>학회 회원 수주 용역 간접비8% 적용</li>
                        </ul>
                    </li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">회비</h3>
                </div>
                <ul class="list-type list-type-bar">
                    <li>입회비: 20,000원</li>
                    <li>정회원 연회비: 50,000원</li>
                    <li>종신회원 회비: 700,000원(단, 55세 이상은 400,000원)</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">납부방법</h3>
                </div>
                <ul class="list-type list-type-bar">
                    <li>로그인 후, 회비납부내역에 접속하셔서, 우측 상단의 [회비 납부하기]를 통해 아래 세 가지 방법 중 택1하여 결제 부탁드립니다.</li>
                    <li>카드결제 / 가상계좌 / 간편결제</li>
                </ul>
                @if(empty(thisPK()))
                <div class="btn-wrap text-center">
                    <a href="{{ route('join', ['gubun'=>'N', 'step'=>'1']) }}" class="btn btn-type1 color-type6">일반회원 가입하기</a>
                </div>
                @endif
            </div>
            <!-- //일반회원 -->

            <!-- 특별회원 -->
            <div class="signup-wrap sub-tab-con js-tab-con">
                <div class="bg-box">
                    <strong>특별회원</strong> 가입
                </div>

                <div class="sub-tit-wrap mt-0">
                    <h3 class="sub-tit">회원의 종류</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>중소기업 / 국가기관, 공기업(중견기업, 국가기관, 정부투자기관, 공기업) / 대기업</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">가입혜택</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>학술대회 참가 시 회원사 직원 최대 5인까지 등록비 면제, 6인부터 등록비 할인</li>
                    <li>학술대회 논문발표 시 논문발표자의 신입회비 면제</li>
                    <li>대기업의 경우 국문학회지에 광고를 연1회 보너스 게재</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">회비</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>중소기업: 500,000원</li>
                    <li>중견기업, 국가기관, 공기업: 1,000,000원</li>
                    <li>대기업: 2,000,000원</li>
                    <li>기타: 회원사 규정이 별도로 있는 경우, 이사회의 승인 하에 금액을 결정한다</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">납부방법</h3>
                </div>
                <ul class="list-type list-type-bar">
                    <li>로그인 후, 회비납부내역에 접속하셔서, 우측 상단의 [회비 납부하기]를 통해 아래 세 가지 방법 중 택1하여 결제 부탁드립니다.</li>
                    <li>카드결제 / 가상계좌 / 간편결제</li>
                </ul>

                @if(empty(thisPK()))
                <div class="btn-wrap text-center">
                    <a href="{{ route('join', ['gubun'=>'S', 'step'=>'1']) }}" class="btn btn-type1 color-type6">특별회원 가입하기</a>
                </div>
                @endif
            </div>
            <!-- //특별회원 -->

            <!-- 단체회원 -->
            <div class="signup-wrap sub-tab-con js-tab-con">
                <div class="bg-box">
                    <strong>단체회원</strong> 가입
                </div>

                <div class="sub-tit-wrap mt-0">
                    <h3 class="sub-tit">회원의 종류</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>도서관, 부서, 연구소 등 단위의 회원</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">가입혜택</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>당해 연도 단체회비 납부한 회원사 직원들은 학술대회 등록비 정회원가로 할인 혜택</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">회비</h3>
                </div>
                <ul class="list-type list-type-dot green">
                    <li>연 150,000원</li>
                </ul>

                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">납부방법</h3>
                </div>
                <ul class="list-type list-type-bar">
                    <li>로그인 후, 회비납부내역에 접속하셔서, 우측 상단의 [회비 납부하기]를 통해 아래 세 가지 방법 중 택1하여 결제 부탁드립니다.</li>
                    <li>카드결제 / 가상계좌 / 간편결제</li>
                </ul>
                @if(empty(thisPK()))
                <div class="btn-wrap text-center">
                    <a href="{{ route('join', ['gubun'=>'G', 'step'=>'1']) }}" class="btn btn-type1 color-type6">단체회원 가입하기</a>
                </div>
                @endif
            </div>
            <!-- //단체회원 -->

        </div>
    </article>
@endsection

@section('addScript')
@endsection
