@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="journal-conbox">
                <div class="sub-tab-wrap type3">
                    <ul class="sub-tab-menu">
                        <li ><a href="{{ route('publication.korean',['tab'=>1]) }}">소개</a></li>
                        <li class="on"><a href="{{ route('publication.korean',['tab'=>2]) }}">편집위원장 인사말</a></li>
                        <li><a href="{{ route('publication.korean',['tab'=>3]) }}">편집위원회</a></li>
                        <li><a href="https://submit.kosenv.or.kr/" target="_blank">투고하기</a></li>
                    </ul>
                </div>

                <div class="greeting-wrap">
                    <div class="img-wrap">
                        <div class="img"><img src="/assets/image/sub/img_journal_greeting.png" alt="이원태 (금오공대)"></div>
                        <div class="img-tit">
                            편집위원장 <br>
                            <strong>이원태 (금오공대)</strong>
                        </div>
                    </div>
                    <div class="text-wrap">
                        대한환경공학회지는 1979년 창간되어 우리나라 환경공학 분야의 다양성을 추구하며 지속적으로 발전해 왔습니다. <br>
                        우리 학회지는 한국연구재단에 등재된 환경분야 학술지 중 KCI 인용지수가 높고 매월 발간되는 학술지입니다. <br>
                        이 모든 것은 여러분의 관심과 참여로 가능하였습니다. <br>
                        소중한 논문을 투고해 주신 저자들과 우수한 논문 선정을 위해 심사해 주신 심사자들께 감사드립니다. <br>
                        대한환경공학회지가 여러분의 우수한 논문과 함께 한 단계 더 도약하기를 바랍니다.
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
