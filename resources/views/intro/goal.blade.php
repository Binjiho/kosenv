@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap mt-0">
                <h3 class="sub-tit">설립목적</h3>
            </div>
            <div class="goal-conbox">
                <p>
                    본 학회는 1978년에 설립된 학술단체로 환경공학 학문의 발전과, <br>
                    환경공학기술자의 지위향상, 환경공학기술의 개발 및 지도, 환경보전대책에 관한 조사연구 및 건의, <br>
                    회원상호간의 친목 및 협조를 목적으로 하고 있습니다.
                </p>
            </div>

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">주요사업</h3>
            </div>
            <ul class="business-list">
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business01.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            회지 및 환경공학에 관한 <br class="m-br">기술도서의 출판
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business02.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            환경공학기술에 관한 <br class="m-br">연구발표회, 강연회, <br class="m-br">간담회의 개최와 견학, 시찰
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business03.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            환경오염방지에 대한 조사연구, <br class="m-br">기술개발 및 기술지도
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business04.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            환경공학시술에 관한 <br>기준 및 용어제정
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business05.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            환경보존에 관한 자문
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business06.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            환경오염방지 향상에 <br class="m-br">공헌한 회원의 표창 및 장학사업
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business07.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            국내외 관련 제 학회 및 <br class="m-br">국제기구와의 교류 및 회의참석
                        </p>
                    </div>
                </li>
                <li>
                    <span class="icon"><img src="/assets/image/sub/img_business08.png" alt=""></span>
                    <div class="text-wrap">
                        <p>
                            기타 본회의의 <br class="m-br">목적달성에 필요한 사항
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
