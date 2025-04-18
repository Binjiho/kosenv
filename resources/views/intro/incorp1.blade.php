@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tab-wrap type3">
                <ul class="sub-tab-menu js-tab-menu">
                    <li class="on"><a href="#n">정관</a></li>
                    <li><a href="#n">규정</a></li>
                </ul>
            </div>
            <!-- s:정관 -->
            <div class="sub-tab-con js-tab-con" style="display: block">
                <div class="term-con-wrap">
                    <div class="term-tit">제 1장 총칙</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제1조(명칭)</strong>
                                <div>
                                    본회는 사단법인 대한환경공학회라 칭한다.
                                </div>
                            </li>
                            <li>
                                <strong>제2조(목적)</strong>
                                <div>
                                    본회의 목적은 다음과 같다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            환경공학학문의 발전
                                        </li>
                                        <li>
                                            환경공학기술자의 지위향상
                                        </li>
                                        <li>
                                            환경공학기술의 개발 및 지도
                                        </li>
                                        <li>
                                            환경보전대책에 관한 조사연구 및 건의
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제3조(사무소)</strong>
                                <div>
                                    본회의 주된 사무소는 서울특별시에 둔다.
                                </div>
                            </li>
                            <li>
                                <strong>제4조(사무)</strong>
                                <div>
                                    본회는 제2조의 목적을 달성하기 위하여 다음의 사업을 한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회지 및 환경공학에 관한 기술도서의 출판
                                        </li>
                                        <li>
                                            환경공학기술에 관한 연구발표회, 강연회, 간담회의 개최와 견학, 시찰
                                        </li>
                                        <li>
                                            환경오염방지에 대한 조사연구, 기술개발 및 기술지도
                                        </li>
                                        <li>
                                            환경공학기술에 관한 기준 및 용어제정
                                        </li>
                                        <li>
                                            환경보전에 관한 자문
                                        </li>
                                        <li>
                                            환경오염방지 향상에 공헌한 회원의 표창 및 장학사업
                                        </li>
                                        <li>
                                            국내외 관련 제 학회 및 국제기구와의 교류 및 회의참석
                                        </li>
                                        <li>
                                            기타 본회의 목적달성에 필요한 사항
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제5조(지회의 설치와 운영)</strong>
                                <div>
                                    본회는 서울특별시, 각 광역시 및 도에 지회를 둘 수 있으며, 지회의 설치와 운영에 관한 사항은 별도의 규정으로 정한다.
                                </div>
                            </li>
                            <li>
                                <strong>제6조(위원회의 설치와 운영) </strong>
                                <div>
                                    본회는 학회의 원활한 운영을 위하여 상임위원회와 특별위원회를 둘 수 있으며 세부사안은 별도 규정으로 정한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 2장 회원 및 회비</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제7조(회원의 자격)</strong>
                                <div>
                                    제8, 9조에 해당되는 자는 본회의 소정의 입회원서 및 입회비를 제출 하고 이사회의 승인을 얻어야 한다(11조에 해당하는 자는 입회비 및 연회비를 면제한다). <br>
                                    (회원) 본회회원은 정회원, 특별회원, 명예회원, 단체회원의 4종으로 나눈다.
                                </div>
                            </li>
                            <li>
                                <strong>제8조(정회원)</strong>
                                <div>
                                    정회원은 다음의 자격 가운데 하나를 구비한 자로서 이사회가 승인하는 자로 한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            환경공학계통의 정규대학 졸업자
                                        </li>
                                        <li>
                                            기타 정규대학 졸업자로서 환경공학부문의 실무경력이 3년 이상인 자
                                        </li>
                                        <li>
                                            전 1, 2항과 동등한 자격을 가졌다고 인정되는 자
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제9조(단체회원)</strong>
                                <div>
                                    단체회원은 학교, 도서관, 연구소 등으로 이사회의 동의를 얻은 비영리단체로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제11조(명예회원)</strong>
                                <div>
                                    명예회원은 환경공학 및 관련된 과학기술분야에서 학식, 덕망이 높고 본 학회발전에 적극 협조한 국내외 인사 중에서 이사회가 추천한다. 단, 명예회원은 회원이 가지는 모든 권리와 의무를 향유하되 입회비 및 연회비를 면제한다.
                                </div>
                            </li>
                            <li>
                                <strong>제12조(특별회원)</strong>
                                <div>
                                    본회의 목적과 전업에 찬동하고 소정금액의 회비 등을 납부하여 이사회의 동의를 얻은 사업체로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제13조(회원의 권리와 사무)</strong>
                                <div>
                                    본회의 회원은 소정의 회비를 납부함으로써 정관 및 규정에 의한 권리와 의무를 갖는다. 다만, 정회원 이외는 피선거권을 갖지 못한다.
                                </div>
                            </li>
                            <li>
                                <strong>제14조(회원의 제명 및 자격정지)</strong>
                                <div>
                                    본회의 회원은 다음 사유가 있을 때 이사회의 의결을 거쳐 회장이 자격정지 또는 제명할 수 있다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            사망 또는 실종신고
                                        </li>
                                        <li>
                                            본인의 탈퇴
                                        </li>
                                        <li>
                                            본회의 명예를 훼손하는 행위를 했을 때
                                        </li>
                                        <li>
                                            5년 이상 정회원 회비를 미납하였을 경우
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제14조의 2(자격정지 회원의 복권)</strong>
                                <div>
                                    자격이 정지된 회원은 이사회의 승인을 거쳐 복권할 수 있다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            제 14조 2항에 의해 탈퇴한 회원이 입회원서를 갖추어 입회비를 납부하고, 당해연도 연회비 혹은 종신회비 납부 시
                                        </li>
                                        <li>
                                            제 14조 3항에 의해 자격 정지된 회원이 복권을 희망하고 당해연도 정회원 연회비 혹은 종신회비 납부 후 이사회의 승인 획득 시
                                        </li>
                                        <li>
                                            제 14조 4항에 의해 자격 정지된 회원이 복권을 희망하고, 5년 치 정회원 연회비 혹은 종신회비 납부 후 이사회의 승인 획득 시
                                        </li>

                                    </ol>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 3장 임원 및 사무국</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제15조(임원 및 임기)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            본회의 임원으로 회장 1인과 국・영문편집위원장을 포함한 부회장 14인 이내, 지회장 7인 이내, 총무이사를 포함한 이사 80인 이내와 감사 2인을 둔다.
                                        </li>
                                        <li>
                                            임원의 임기는 2년으로 하되 중임할 수 있으며, 보선임원은 전임자의 잔여기간 재임한다. 단, 회장은 중임할 수 없다.
                                        </li>
                                        <li>
                                            임원은 명예직으로 한다.
                                        </li>
                                        <li>
                                            임원 임기는 회장 임기가 시작하는 해의 1월 1일부터 다음해 12월 31일까지로 한다.
                                        </li>
                                        <li>
                                            국영문 편집위원장의 임기는 6년으로 한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제16조(임원의 선출방법)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회장은 회장선출규정을 따르고, 회장이외의 임원은 회장이 선임하며, 총회의 인준을 받는다. 다만, 정회원이 아닌 자는 본회의 임원이 될 수 없다.
                                        </li>
                                        <li>
                                            임원이 임기도중 사퇴하였거나 사망하여 결원이 생길 경우에는 다음과 같이 그 잔여임기를 계승한다.
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>①</span>
                                                    <div>
                                                        회 장 : 연상인 부회장
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>②</span>
                                                    <div>
                                                        부회장 : 연상인 이 사
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>③</span>
                                                    <div>
                                                        이사 및 감사 : 이사회에서 보궐 선거
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제17조(임원의 직무)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회장은 본회를 대표하고 회무를 총괄한다.
                                        </li>
                                        <li>
                                            부회장은 회장을 보좌하며, 상임위원회의 위원장을 겸할 수 있다.
                                        </li>
                                        <li>
                                            이사는 이사회를 출석하여 본회의 사무에 관한 사항을 의결하며 회장 및 이사회의 위임사항을 처리한다.
                                        </li>
                                        <li>
                                            감사는 이사회의 운영과 그 업무에 관한 사항 등 회무전반을 감사하여 총회에 보고하고 이사회에 출석하여 의견을 진술할 수 있으나 의결권은 없다. 감사는 이사를 겸할 수 없다. 또한 감사결과 부정 또는 부당한 일이 있으면 이사회 및 총회의 소집을 요구할 수 있다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제18조(명예회장 및 고문) </strong>
                                <div>
                                    본회에 명예회장과 고문 약간 명을 둘 수 있다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            명예회장은 정회원으로서 본회의 육성발전에 현저한 공로가 있는 자 중 이사회에서 추천하여 총회의 의결을 거쳐 추대한다.
                                        </li>
                                        <li>
                                            고문은 정회원으로서 본회발전에 공로가 지대한 자 중 이사회의 심의를 거쳐 추대한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제19조(임원의 결격사유) </strong>
                                <div>
                                    다음 각 항의 1에 해당하는 자는 본회의 임원이 될 수 없다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            피성년후견인, 피한정후견인 또는 파산의 선고를 받고 복권되지 아니한 자.
                                        </li>
                                        <li>
                                            금고이상의 형을 받고 그 집행이 종료되거나 또는 집행을 받지 아니하기로 확정된 후 3년이 경과되지 아니한 자
                                        </li>
                                        <li>
                                            금고이상의 형을 받고 그 집행 예정기간이 완료된 날로부터 1년을 경과하지 아니한 자
                                        </li>
                                        <li>
                                            금고이상의 형을 선고유예 받고 그 유예기간 중에 있는 자
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제19조의 2(임원의 해임)</strong>
                                <div>
                                    임원이 다음 각호의 1에 해당하는 행위를 한 때에는 총회의 의결을 거쳐 해임할 수 있다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            본회의 목적에 위배되는 행위
                                        </li>
                                        <li>
                                            임원간의 분쟁․회계부정 또는 현저한 부당행위
                                        </li>
                                        <li>
                                            본회의 업무를 방해하는 행위
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제20조(사무국)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            총회 및 이사회에서 의결된 사항과 기타학회의 통상사무를 수행하기 위하여 사무국장, 직원 및 약간의 간사를 둔다.
                                        </li>
                                        <li>
                                            사무국장 및 간사는 회장이 임명하고 이사회의 인준을 받는다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 4장 회의</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제21조(회의의 종류) </strong>
                                <div>
                                    본회 회의는 정기총회, 임시총회, 평의원회, 이사회 및 확대이사회로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제22조(정기총회) </strong>
                                <div>
                                    정기총회는 매년 상반기에 회장이 이를 소집한다.
                                </div>
                            </li>
                            <li>
                                <strong>제23조(임시총회) </strong>
                                <div>
                                    임시총회는 다음의 경우에 회장이 소집한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회장이 필요하다고 인정할 때
                                        </li>
                                        <li>
                                            이사회의 의결로 요구할 때
                                        </li>
                                        <li>
                                            정회원 총수의 5분의 1 이상이 요구할 때
                                        </li>
                                        <li>
                                            제17조 4항의 규정에 의하여 감사가 소집을 요구할 때
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제24조(총회소집) </strong>
                                <div>
                                    총회소집은 회기 7일전에 회의목적사항과 기일을 제시하여 회원에게 통지하여야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제25조(총회의 성립과 의결) </strong>
                                <div>
                                    총회는 평의원 1/3이상의 출석으로 성립하며, 위임장도 출석으로 간주한다. 출석인원 과반수의 찬성으로 의결한다.
                                </div>
                            </li>
                            <li>
                                <strong>제26조(총회의 의결사항) </strong>
                                <div>
                                    총회는 다음 사항을 의결한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            임원 선출 및 해임에 관한 사항
                                        </li>
                                        <li>
                                            정관변경 및 해산에 관한 사항
                                        </li>
                                        <li>
                                            예산 및 결산에 관한 사항
                                        </li>
                                        <li>
                                            사업계획상황
                                        </li>
                                        <li>
                                            재산의 득실 및 변경에 대한 사항
                                        </li>
                                        <li>
                                            기타 회무운영에 관한 중요사항
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제27조(이사회)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            이사회는 회장, 부회장 및 이사 및 감사로 구성한다.
                                        </li>
                                        <li>
                                            이사회는 년 3회 이상 가져야 하며 회장이 소집한다. 단, 회장이 필요하다고 인정할때는 수시로 소집할 수 있다.
                                        </li>
                                        <li>
                                            회장은 다음 각 항의 1에 해당하는 소집요구가 있을 때에는 소집요구일로부터 20일 이내에 소집하여야 한다.
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>가.</span>
                                                    <div>
                                                        재적이사 1/2 이상이 회의의 목적을 제시하여 소집 요구할 때
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>나.</span>
                                                    <div>
                                                        제17조 제4항의 규정에 의하여 감사가 소집을 요구할 때
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            차기회장은 이사회에 참관하며 발언권은 있으나 의결권은 주어지지 않는다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제28조(이사회의 성립과 의결) </strong>
                                <div>
                                    이사회는 재적인원 과반수의 출석으로 성립하며 출석인원 과반수의 찬성으로 의결한다. 다만, 정관변경에 관한 사항의 경우에는 재적이사 3분의 2이상의 찬성으로 의결한다.
                                </div>
                            </li>
                            <li>
                                <strong>제29조(이사회의 의결사항) </strong>
                                <div>
                                    이사회는 다음 사항을 의결한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회원가입승인에 관한 사항
                                        </li>
                                        <li>
                                            사업계획수립 및 예산편성과 결산에 관한 사항
                                        </li>
                                        <li>
                                            재산의 득실 및 변경에 관한 사항
                                        </li>
                                        <li>
                                            총회준비에 관한 사항
                                        </li>
                                        <li>
                                            정관변경에 관한 사항
                                        </li>
                                        <li>
                                            결원이사·감사 보선에 관한 사항
                                        </li>
                                        <li>
                                            제규칙 제·개정에 관한 사항
                                        </li>
                                        <li>
                                            회비에 관한 사항
                                        </li>
                                        <li>
                                            기타 필요한 사항
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제30조(확대이사회)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            확대이사회는 고문단(명예회장, 고문단), 이사진, 지회장으로 구성한다. 단, 고문단은 발언권은 있으나 의결권은 부여하지 않는다.
                                        </li>
                                        <li>
                                            확대이사회는 년 2회 이상 가져야 하며, 회장이 필요하다고 인정하는 경우에 소집한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제31조(평의원회)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            평의원회는 당연직평의원과 별도의 “평의원선출규정”에 따라 선출된 100명 이내의 선출직평의원으로 구성한다.
                                        </li>
                                        <li>
                                            당연직 평의원에는 명예회장, 고문, 현임원, 지회장, 전문위원회위원장이 포함된다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제32조(평의원의 임기)</strong>
                                <div>
                                    평의원의 임기는 2년 이내로 하며 연임할 수 있다. 임기 중 결원이 발생할 시 보선하지 않는다.
                                </div>
                            </li>
                            <li>
                                <strong>제33조(평의원회의 성립과 의결)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            평의원회는 다음과 같이 소집할 수 있다.
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>가.</span> <div>회장이 소집</div>
                                                </li>
                                                <li>
                                                    <span>나.</span> <div>이사회의 의결</div>
                                                </li>
                                                <li>
                                                    <span>다.</span> <div>평의원의 1/5이상이 요구</div>
                                                </li>
                                                <li>
                                                    <span>라.</span> <div>회장은 회의가 소집될 시, 회의소집 7일전까지 회의 일시, 장소 및 의제를 공지하여야 한다.</div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            평의원회는 평의원 1/2이상의 출석으로 성립하며, 출석 평의원 과반수의 찬성으로 의결한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제34조(평의원회의 의결사항) </strong>
                                <div>
                                    평의원회는 총회의 의결로 평의원회에 위임한 사항을 의결한다.
                                </div>
                            </li>
                            <li>
                                <strong>제35조(회의의 의결 및 제척)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            총회 및 이사회의 의결사항이 제14조 3항의 경우와 같이 특정회원의 자격제한에 관한 경우에는 그 회원은 표결로부터 제척된다.
                                        </li>
                                        <li>
                                            위임장을 제출한 자는 출석으로 간주하며, 의결권은 위임받은 자에게 부여한다.
                                        </li>
                                        <li>
                                            자신에 관한 사항에 대해서는 의결에 참여할 수 없다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제36조(총회 및 이사회의 의장) </strong>
                                <div>
                                    총회 및 이사회의 의장은 회장이 된다.
                                </div>
                            </li>
                            <li>
                                <strong>제37조(의사록) </strong>
                                <div>
                                    본회의 모든 회의의 의사록은 총무이사가 작성하고 의장 및 출석한 이사 전원이 기명 날인한 다음 사무국에서 보관한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 5장 회계</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제38조(재정) </strong>
                                <div>
                                    본회의 재정은 다음과 같은 수입으로 충당한다. 본회의 사무과정에서 발생하는 수입은 공익을 위하여 사용하고 불특정 다수의 수혜자를 위함으로 한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회원의 회비
                                        </li>
                                        <li>
                                            단체 및 개인의 보조금
                                        </li>
                                        <li>
                                            단체 및 개인의 기부금
                                        </li>
                                        <li>
                                            자산에서 생긴 수익
                                        </li>
                                        <li>
                                            특별회계수입
                                        </li>
                                        <li>
                                            기타 수입
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제38조의 2(재산의 구분) </strong>
                                <div>
                                    본회의 재산은 다음과 같이 기본재산과 보통재산으로 구분하며, 그 목록은 “별지 1”과 같다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            기본재산은 본회 설립시 그 설립자가 출연한 재산과 이사회에서 기본재산으로 정한 재산으로 한다.
                                        </li>
                                        <li>
                                            보통재산은 기본재산 이외의 재산으로 한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제38조의 3(기본재산의 처분 등) </strong>
                                <div>
                                    본회의 기본재산을 처분(매도․증여․교환을 포함한다)하고자 할 때에는 제43조의 규정에 의한 정관변경 허가의 절차를 거쳐야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제39조(예산결산)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            회장은 매년도 사업계획서 및 예산서를 사업년도 개시 1개월 전까지 작성하여 이사회의 의결을 거쳐 총회의 승인을 받아야 한다.
                                        </li>
                                        <li>
                                            회장은 매년도 결산 및 재산목록을 작성하여 이사회의 의결을 거쳐 총회의 승인을 받아야 한다. 단, 이사회에 제출하기 전에 감사의 감사를 받아야 한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제40조(보고)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            매년도말 결산 및 재산목록은 총회의 승인을 받은 후 환경부장관에게 보고한다.
                                        </li>
                                        <li>
                                            홈페이지를 통해 「연간 기부금 모금액 및 활용실적」을 공개한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제41조(회계년도) </strong>
                                <div>
                                    본회의 회계년도는 매년 1월 1일부터 12월 31일로 한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 6장 부칙</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제42조(시행규정) </strong>
                                <div>
                                    본 정관에 규정이 없는 사항으로서의 본회운영에 필요한 사항은 이사회의 의결을 거쳐 별도로 이를 정한다.
                                </div>
                            </li>
                            <li>
                                <strong>제43조(정관의 변경) </strong>
                                <div>
                                    본회 정관을 변경하고자 할 때에는 이사회와 총회의 의결을 거쳐 환경부장관의 승인을 받아야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제44조(해산 및 재산의 잔여처분)</strong>
                                <div>
                                    본회의 기본재산을 처분(매도․증여․교환을 포함한다)하고자 할 때에는 제43조의 규정에 의한 정관변경 허가의 절차를 거쳐야 한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            본회의 해산은 총회에서 출석자 4분의 3 이상의 의결을 거쳐 환경부장관의 승인을 받아야 한다.
                                        </li>
                                        <li>
                                            해산에 따르는 잔여재산의 처분은 총회에서 출석자 4분의 3 이상의 의결을 거쳐 환경부장관의 승인을 받아 국가ㆍ지방자치단체 또는 유사한 목적을 가진 비영리법인에 귀속한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제45조(정관시행) </strong>
                                <div>
                                    본 정관의 효력은 환경부장관의 인가를 받는 날로부터 시행한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">개정</div>
                    <div class="term-conbox">
                        <p>
                            1차개정: 1994. 10.15 <br>
                            2차개정: 1995. 11. 05 <br>
                            3차개정: 2001. 05. 11 <br>
                            4차개정: 2003. 01. 10 <br>
                            5차개정: 2007. 02. 28 <br>
                            6차개정: 2010. 08. 16 <br>
                            7차개정: 2013. 01. 17 <br>
                            8차개정: 2016. 07. 17 <br>
                            9차개정: 2018. 03. 09 <br>
                            10차개정: 2022. 03. 07 <br>
                            11차개정: 2024. 03. 06
                        </p>
                    </div>
                </div>
            </div>
            <!-- //e:정관 -->

            <!-- s:규정 -->
            <div class="sub-tab-con js-tab-con">
                <div class="term-con-wrap">
                    <div class="term-tit">시행규정</div>
                    <div class="term-conbox">
                        <p>
                            1982. 04. 24제정 <br>
                            1988. 05. 061차 개정 <br>
                            1994. 10. 152차 개정 <br>
                            1997. 013차 개정 <br>
                            1999. 11. 054차 개정 <br>
                            2003. 01. 105차 개정 <br>
                            2008. 10. 236차 개정 <br>
                            2012. 03. 087차 개정 <br>
                            2012. 07. 058차 개정 <br>
                            2016. 03. 109차 개정 <br>
                            2017. 08. 2410차 개정 <br>
                            2018. 08. 2311차 개정 <br>
                            2020. 07. 1612차 개정 <br>
                            2023. 04. 2013차 개정 <br>
                            2024. 06. 2714차 개정 <br>
                            2024. 09. 2615차 개정 <br>
                            2024. 12. 1916차 개정
                        </p>
                    </div>

                    <div class="term-tit">제 1장 총칙</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>(운영) </strong>
                                <div>
                                    본회의 운영에 관해서는 정관 이외에 본 <strong>규정</strong>에 따라야 한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 2장 회원 및 회비</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>(정회원의 입회) </strong>
                                <div>
                                    정회원이 되려면 소정의 입회원서에 입회비와 연회비를 첨부하여 사무국에 제출하여야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조 &lt;삭제&gt;</strong><br>
                                <strong>(회원자격의 취득)</strong>
                                <div>
                                    회원은 입회통지서의 발행일로부터 그 자격을 취득한다.
                                </div>
                                <strong>(회비의 납부)</strong>
                                <div>
                                    회비는 전납하여야 한다.
                                </div>
                                <strong>(입회비 및 회비)</strong>
                                <div>
                                    정회원의 입회비 및 회원의 종별에 따르는 연회비는 다음과 같다.
                                    <div class="table-wrap mt-10">
                                        <table class="cst-table">
                                            <cpation class="hide">연회비</cpation>
                                            <colgroup>
                                                <col style="width: 25%;">
                                                <col>
                                            </colgroup>
                                            <tbody>
                                            <tr>
                                                <th scope="row">입회비</th>
                                                <td class="text-left">
                                                    20,000원
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">정회원의 연회비</th>
                                                <td class="text-left">
                                                    50,000원
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">단체회원의 연회비</th>
                                                <td class="text-left">
                                                    150,000원
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">특별회원</th>
                                                <td class="text-left">
                                                    <strong>[특별회원사 연회비]</strong>
                                                    <ul class="list-type list-type-bar mt-5 mb-20">
                                                        <li>
                                                            중소기업: 50만원
                                                        </li>
                                                        <li>
                                                            중견기업, 국가기관, 공기업: 100만원
                                                        </li>
                                                        <li>
                                                            대기업: 200만원
                                                        </li>
                                                        <li>
                                                            기타: 회원사 규정이 별도로 있는 경우, 이사회의 승인 하에 금액을 결정한다.
                                                        </li>
                                                    </ul>
                                                    <strong>[특별회원사 혜택]</strong>
                                                    <ul class="list-type list-type-bar mt-5">
                                                        <li>
                                                            학술대회 참가 시 회원사 직원 5인까지 등록비를 면제하며, 6인부터는 참가비를 정회원가로 할인한다(단, 특별회비 구분에 따라 차등 혜택).
                                                        </li>
                                                        <li>
                                                            학술대회 논문발표 시 논문발표자의 신입회비를 면제해 드립니다.
                                                        </li>
                                                        <li>
                                                            대기업의 경우 대한환경공학회지(국문학회지)에 연1회 보너스 광고를 게재해 드립니다.
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">종신회원</th>
                                                <td class="text-left">
                                                    회원 중에서 연회비 70만원을 일시 납입한 회원은 종신회원으로 한다. <br>
                                                    단, 정회원 중 만 55세 이상은 40만원을 일시 납입 시 종신회원으로 한다.
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 3 장 임원</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 7 조 (총무이사) </strong>
                                <div>
                                    본회의 회무를 집행하기 위해 총무이사를 선임하여 회무관리를 담당한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 8 조 (상임위원회)</strong>
                                <div>
                                    본 학회 운영의 활성화를 위해 다음과 같이 상임위원회를 설치한다.&lt;가나다 순&gt;
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>①</span>
                                            <div>
                                                교육위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>②</span>
                                            <div>
                                                국문편집위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>③</span>
                                            <div>
                                                국제협력위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>④</span>
                                            <div>
                                                기획위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑤</span>
                                            <div>
                                                대기위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑥</span>
                                            <div>
                                                물위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑦</span>
                                            <div>
                                                미래소통특별위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑧</span>
                                            <div>
                                                환경산업위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑨</span>
                                            <div>
                                                여성과학위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑩</span>
                                            <div>
                                                영문편집위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑪</span>
                                            <div>
                                                자원재생위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑫</span>
                                            <div>
                                                정책위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑬</span>
                                            <div>
                                                탄소중립녹색성장 특별위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑭</span>
                                            <div>
                                                토양·지하수위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑮</span>
                                            <div>
                                                통합물관리 특별위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑯</span>
                                            <div>
                                                포상선정위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑰</span>
                                            <div>
                                                학술위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑱</span>
                                            <div>
                                                홍보위원회
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑲</span>
                                            <div>
                                                산업소통 특별위원회
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 9 조 (명예이사)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            명예이사 후보는 매년 정년/퇴직 후 2년 이내의 만 60세 이상 학회회원 중 다음을 만족하는 회원을 대상으로 회장단에서 30인 이내를 추천한다.
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>A.</span> <div>대한환경공학회에서 부회장, 국/영문 편집장, 총무이사, 또는 재무이사를 역임한 회원</div>
                                                </li>
                                                <li>
                                                    <span>B.</span> <div>지회장을 역임한 회원</div>
                                                </li>
                                                <li>
                                                    <span>C.</span> <div>대한환경공학회 펠로우(석좌) 및 마스터 (명장)</div>
                                                </li>
                                                <li>
                                                    <span>D.</span> <div>이외, 학회의 공헌이 뚜렷하여 회장단 및 고문단에서 추천한 회원</div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            이외, 학회의 공헌이 뚜렷하여 회장단 및 고문단에서 추천한 회원
                                        </li>
                                        <li>
                                            당해연도 추천자들을 대상으로 고문단에서 10인 이내의 후보자를 추천한다.
                                        </li>
                                        <li>
                                            고문단에서 추천한 후보자들의 학회 학술발전 및 사회봉사에 대한 기여를 고려하여 회장은 매년 10인 이내에서 임명할 수 있다.
                                        </li>
                                        <li>
                                            명예이사는 학회가 주관하는 세미나/포럼/학술대회 등에 무료 등록이 가능하다.
                                        </li>
                                        <li>
                                            명예이사는 확대이사회에 참석할 수 있으며, 의결권을 제외하고 이사와 동등한 권한을 갖는다.
                                        </li>

                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 10 조 (이사회 회의록) </strong>
                                <div>
                                    이사회 회의록은 총무이사가 작성하고 회장단의 확인 후에 사무국에 보관한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 11 조 (회장단) </strong>
                                <div>
                                    회장단은 회장, 기획위원장, 총무이사, 재무이사로 하고, 확대회장단은 회장, 감사, 부회장, 지회장, 총무이사, 재무이사로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 12 조 (특별위원회) </strong>
                                <div>
                                    이사회의 결의에 따라 특별위원회 등 추가의 위원회를 둘 수 있다.
                                </div>
                            </li>
                            <li>
                                <strong>제 13 조 (임원기금)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            임원은 학회발전을 위해 임원의 임기동안 임원기금을 납부한다.
                                        </li>
                                        <li>
                                            임원기금은 다음과 같다. <br>
                                            <ul class="list-type list-type-dot">
                                                <li>
                                                    회 장 : 30만원
                                                </li>
                                                <li>
                                                    부회장 : 20만원
                                                </li>
                                                <li>
                                                    이 사 : 10만원
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            임원기금을 납부함으로써 임원의 의결권이 효력을 갖는다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">제 4 장 학술대회</div>
                    <div class="term-conbox">
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 14 조 (학술대회의 종류) </strong>
                                <div>
                                    본회 학술대회는 국내학술대회, 국제학술대회, 전문가그룹 학술대회 등으로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 15 조 (학술대회 개최일자)  </strong>
                                <div>
                                    본회 학술대회 중 국내학술대회, 국제학술대회는 매년 11월 첫번째 수요일, 목요일, 금요일에 개최하며, 전문가그룹 학술대회는 매년 6월 마지막주 목요일, 금요일에 개최한다. 단, 특별한 이유로 개최일자의 변경이 필요한 경우에는 이사회의 의결에 따라 별도로 정할 수 있다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">포상 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            1982. 04. 24 제정 <br>
                            2000. 10. 271차 개정 <br>
                            2003. 01. 102차 개정 <br>
                            2010. 11. 033차 개정 <br>
                            2013. 05. 304차 개정 <br>
                            2016. 09. 225차 개정 <br>
                            2017. 08. 246차 개정 <br>
                            2018. 10. 247차 개정 <br>
                            2023. 03. 248차 개정 <br>
                            2024. 12. 199차 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    본 규정은 사)대한환경공학회의 학문적 업적, 기술발전 공로 및 학회발전기여등에 대하여 포상하기 위한 세부사항을 정하는 것을 목적으로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조(포상의 종류)</strong>
                                <div>
                                    본 규정에 의한 포상의 종류는 다음과 같다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            공로상 : 5명이내
                                        </li>
                                        <li>
                                            학술상 : 2명이내
                                        </li>
                                        <li>
                                            기술상 : 2명이내
                                        </li>
                                        <li>
                                            논문상 : 4명이내
                                        </li>
                                        <li>
                                            학술대회 논문상 : 50명이내
                                        </li>
                                        <li>
                                            특별상
                                        </li>
                                        <li>
                                            우수전문가그룹상
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조(수상자격)</strong>
                                <div>
                                    수상자는 본 학회 정회원으로 다음 사항에 적합하여야 한다. 단, 특별상은 정회원이 아니어도 수상이 가능하다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            공로상 : 본 학회의 발전에 크게 공헌한 자
                                        </li>
                                        <li>
                                            학술상
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>1)</span> <div>환경공학분야에서 탁월한 연구업적을 이룩한 박사학위 취득 후 15년 이상의 자</div>
                                                </li>
                                                <li>
                                                    <span>2)</span> <div>관련 학회지 및 저서를 통하여 특정 환경공학분야 학문발전과 기술개발에 현저한 업적이 있는 자</div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            기술상 <br>
                                            환경공학회원으로서 환경공학 관련 분야에서 대학원 과정을 포함하여 20년 이상의 경력을 가지고, 독자적인 창의력을 발휘하여 기술향상에 현저히 기여한 자
                                            <ul class="list-type list-type-bar">
                                                <li>보유 기술의 실용화 정도</li>
                                                <li>보유 기술의 매출 실적 규모</li>
                                            </ul>
                                        </li>
                                        <li>
                                            논문상 : 본 학회지에 우수한 논문을 게재한 자
                                        </li>
                                        <li>
                                            학술대회 논문상 : 학술대회에서 내용이 뛰어난 논문을 발표한 자
                                        </li>
                                        <li>
                                            특별상 : 본 학회의 회원 또는 비회원을 막론하고 본 학회의 발전이나 재정확보를 위하여 특별히 공헌한 자
                                        </li>
                                        <li>
                                            우수전문가그룹상 : 전문가그룹 학술대회에 적극적으로 참여하여 학회의 발전에 기여한 그룹
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 4 조(수상자의 선정)</strong>
                                <div>
                                    상의 종류별 수상대상자는 다음 기준으로 선정한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>공로상 : 본 학회에 공로가 있는 자로서 이사회에서 승인을 받은 자</li>
                                        <li>
                                            학술상 : 아래와 같이 학술업적을 평가한 후 학술위원회에서 추천을 하여 이사회에서 승인한 자
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>1)</span> <div>공고일 기준 연구경력과 최근 10년간의 학술업적, 학문적 기여도를 평가하여 선정하며, 학술업적은 연구 실적 및 강연 실적으로 구분한다.</div>
                                                </li>
                                                <li>
                                                    <span>2)</span> <div>연구 실적은 국내외 전문 학술지 논문, 저서 및 특허로 한다.</div>
                                                </li>
                                                <li>
                                                    <span>3)</span> <div>강연 실적은 학·협회 등 공식단체에 의해 개최된 학술회의 기조강연 및 초청강연으로 한다.</div>
                                                </li>
                                                <li>
                                                    <span>4)</span> <div>업적평가는 국제적 인지도 및 저자수에 따라 가중치를 두며 학술위원회에서 별도로 정한다.</div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            기술상 : 산업소통특별위윈회에서 추천을 하여 이사회에서 승인한 자
                                        </li>
                                        <li>
                                            논문상 : 편집위원회에서 대한환경공학회지와 Environmental Engineering Research 에 우수한 논문을 발표한 정회원 중에서 다음의가방법에 의해 수상후보자를 추천한 후 이사회의 승인을 받은 자
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>1)</span> <div>대상 논문의 기간은 전년도 1년을 원칙으로 하되, 편집위원회에서 상황에 따라 별도로 정할 수 있다.</div>
                                                </li>
                                                <li>
                                                    <span>2)</span> <div>게재된 논문 중 많이 인용된 것을 고려하여 선정한다.</div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            학술대회 논문상 <br>
                                            본 학회 국내·국제학술대회의 (구두)논문발표자와 포스터논문발표자 중 우수한 발표를 한 자로 50명이내로 선정한다. 단, 평가기준 및 평가위원은 학술위원회에서 별도로 정하여 시행하되, 선정분야 및 평가방법은 공정하게 하도록 한다.
                                        </li>
                                        <li>특별상 : 이사회에서 승인을 받은 자</li>
                                        <li>우수전문가그룹 : 본 학회의 기획위원회가 주관하는 전문가그룹 학술대회에서 우수한 학술활동를 수행해온 전문가 그룹을 선정한다. 단, 평가기준 및 평가위원은 기획위원회가 별도로 정하여 공정한 심사를 진행한다.</li>
                                        <li>기타 : 사유가 해당되는 자에 대하여 회장이 정함.</li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 5 조(시상시기)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            공로상, 학술상, 기술상, 논문상, 특별상, 기타상은 1년에 1회 총회에서 시상하되 이사회의 의결에 따라 별도로 정할 수 있다.
                                        </li>
                                        <li>
                                            학술대회 논문상, 특별상, 기타상은 학술대회에서 임의로 시상할 수 있다. 단, 학술대회 논문상은 차기 학술대회에서 수여할 수 있다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 6 조(수상의 제한))</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            과거의 수상자는 동일종류의 학술상, 논문상, 기술상에 대하여 해당연도를 포함하여 4년 이내에는 다시 수상할 수 없다. (단, 학술대회 논문상은 예외로 수상 년도 제한을 두지 않으며, 공로상 및 특별상의 경우에도 학회의 공헌도가 높다고 판단되는 경우 회장의 요구에 따라 수상년도의 제한을 예외로 할 수 있다.)
                                        </li>
                                        <li>
                                            동일인이 같은 학술대회회에서 2개 이상의 상을 수여 받을 수 없다.
                                        </li>
                                        <li>
                                            포상에 대한 일반적인 제한요인을 가지거나 학회의 발전에 중대한 저해요인을 가진자는 이사회의 의결에 따라 수상을 제한할 수 있다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 7 조(부상) </strong>
                                <div>
                                    포상에 따른 부상은 회장이 정한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">평의원 선출 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2007. 03. 02 제정 <br>
                            2011. 03. 311차 개정 <br>
                            2012. 07. 052차 개정 <br>
                            2018. 10. 243차 개정 <br>
                            2019. 02. 284차 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조 (평의원의 선출) </strong>
                                <div>
                                    평의원은 후보자를 대상으로 한 난수추첨 방식으로 선출된다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조 (선거관리위원회) </strong>
                                <div>
                                    이사회는 평의원 임기 만료 3개월 전에, 선거관리위원회를 구성하여야 한다. 선거관리위원회 위원장은 당해년도 회장으로 보하고, 위원은 평의원 피선거권을 가진 10명 이내로 위원장의 제청에 따라 이사회의 승인을 얻어 위원장이 위촉한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조 (선거관리) </strong>
                                <div>
                                    회장선출규정 제3조를 따른다.
                                </div>
                            </li>
                            <li>
                                <strong>제 4 조 (선거일정) </strong>
                                <div>
                                    선거관리위원회는 평의원 임기 만료 2개월 전에 선거일정을 공지하여야 하며, 평의원 선출을 임기 만료 1개월 전까지 완료하여야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 5 조 (후보자격) </strong>
                                <div>
                                    평의원 후보는 평의원 선거 10일 이전에 선거년을 포함하여 최근 3년 이상 연회비를 납부한 정회원에 한 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 6 조 (선거방법) </strong>
                                <div>
                                    평의원 정원의 산출, 후보의 선정, 난수 추첨은 선거관리위원회에서 하며, 최종 당선자는 난수추첨 결과를 토대로 회장이 발표한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            선거관리위원회는 평의원 정원과 제5조에서 정한 자격을 갖춘 후보 명단을 확정한다.
                                        </li>
                                        <li>
                                            선거관리위원회는 평의원 후보를 난수추첨을 통해 평의원 정원의 150% 순번까지 추첨된 순서대로 회장에게 통보한다.
                                        </li>
                                        <li>
                                            선거관리위원회는 평의원 정원만큼 당선자를 확정하여 수락여부 및 평의원 회비납부 여부를 확인한 후 회장에게 통보한다. 당선된 후보가 당연직 의원이 되거나, 임기도중 사퇴 및 사망 등의 이유로 결원이 생길 경우에는 난수추첨을 통해 선정된 순서대로 선출직 평의원을 임명하고, 그 잔여임기를 계승한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 7 조 (기타) </strong>
                                <div>
                                    이 규정에 명시하지 않은 사항은 본회 이사회 결정에 따른다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">회장 선출 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2007. 03. 02 제정 <br>
                            2009. 10. 091차 개정 <br>
                            2011. 03. 312차 개정 <br>
                            2018. 10. 243차 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조 (회장의 선출) </strong>
                                <div>
                                    회장은 평의원의 직접투표로 선출된다. 투표는 비밀이 보장되는 온라인투표시스템 방법을 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조 (선거관리위원회) </strong>
                                <div>
                                    이사회는 회장 임기 만료 6개월 전에 선거관리위원회를 구성하여야 한다. 선거관리위원회 위원장은 당해년도 회장으로 보하고, 위원은 평의원 피선거권을 가진 10명 이내로 위원장의 제청에 따라 이사회의 승인을 얻어 위원장이 위촉한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조 (선거관리) </strong>
                                <div>
                                    선거관리위원회는 선거에 관한 공고, 후보의 등록, 투표, 개표 및 당선자 공고 등 모든 사무를 관장한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 4 조 (선거일정) </strong>
                                <div>
                                    선거관리위원회는 회장 임기 만료 5개월 전에 선거일정을 공지 (소식지 발송 및 홈페이지게시)하여야 하며, 회장 선출을 임기 만료 3개월 전까지 완료하여야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 5 조 (후보자격) </strong>
                                <div>
                                    회장 후보는 환경공학계에서 20년 이상의 경력이 있는 자로서 이 회의 임원을 역임하고 정회원으로서 10년 이상인 자에 한 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 6 조 (후보등록) </strong>
                                <div>
                                    회장 후보는 투표개시일 30일전까지 평의원 후보자격이 있는 정회원 20명 이상의 추천을 얻어 후보 등록된 자로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 7 조 (선거운동)</strong>
                                <div>
                                    이 규정에 명시하지 않은 사항은 본회 이사회 결정에 따른다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            선거관리위원회는 각 후보에 관한 이력과 소견을 공지한다 (소식지 발송 및 홈페이지 게시).
                                        </li>
                                        <li>
                                            선거운동 금지 사항
                                            <ul class="list-type list-type-text">
                                                <li>
                                                    <span>가. </span>
                                                    <div>
                                                        인쇄물을 우편 발송하여 선거운동을 하는 것
                                                    </div>
                                                </li>
                                                <li>
                                                    <span>나. </span>
                                                    <div>
                                                        기타 불공정 행위
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            선거운동에 관한 금지 규정을 위반하였을 경우, 선거관리위원회는 후보 자격의 박탈 혹은 선거무효의 결정을 이사회에 건의한다. 이 건의를 위한 위원회의 결정은 2/3 이상의 찬성으로 한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 8 조 (선거방법)</strong>
                                <div>
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            선거관리위원회는 평의원에게 후보 명단과 전자 투표기간 등을 문자, 우편 또는 전자우편으로 통보한다.
                                        </li>
                                        <li>
                                            각 평의원은 전자투표 기간 내에 후보 중 1인에게 투표하여야 한다.
                                        </li>
                                        <li>
                                            후보자가 2인 이상인 경우, 후보자 중 최다 득표자가 당선된 것으로 한다. 다만, 최다 득표자가 2인 이상인 경우, 그들만으로 재투표를 20일 이내로 실시한다.
                                        </li>
                                        <li>
                                            후보자가 1인인 경우, 투표없이 당선자로 확정한다.
                                        </li>
                                        <li>
                                            선거관리위원회는 투표를 개표하여 당선자를 확정하여 발표한다. 당선된 후보가 사퇴할 경우에는 차점자를 당선자로 선정한다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>제 9 조 (기타) </strong>
                                <div>
                                    이 규정에 명시하지 않은 사항은 본회 선거관리위원회의 결정에 따른다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">지회의 설치와 운영에 관한 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            1996. 06. 01 제정 <br>
                            2020. 07. 161차 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    이 규정은 본회 정관 제5조에 의거하여 지회의 설치와 운영에 관한 절차를 정한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조(구성) </strong>
                                <div>
                                    본회는 서울특별시, 각 광역시 및 도의 필요한 곳에 정회원 50명 이상으로 지회를 구성할 수 있다.
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조(설치 및 운영) </strong>
                                <div>
                                    지회는 이사회의 승인을 얻어 설치하고 본회의 총회, 이사회 및 각위원회에서 의결한 사항을 수행하여야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 4 조(지회임원) </strong>
                                <div>
                                    지회장은 지회규약에 의거하여 선임하고 학회장이 임명한다. 지회장은 지회규정에 따라 약간 명의 지회임원을 두어 지회업무를 관장한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 5 조(보고) </strong>
                                <div>
                                    지회장은 당해년도 12월에 다음해의 임원 명단과 회원 명단, 당해 년도 회무보고서와 감사보고서를 회장에게 서면으로 제출해야 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 6 조(지회장 임기) </strong>
                                <div>
                                    회지회장의 임기는 2년으로 하되 1회에 한하여 연임 할 수 있다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">외부 학술 및 기술 상훈 추천 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2007. 03. 02 제정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    이 규정은 본회에 의뢰되는 외부 학술 및 기술 상훈에 대한 피추천자를 정하는 절차를 정한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조 (추천 자격) </strong>
                                <div>
                                    정회원으로 5년 이상인 회원으로서 추천년도를 포함하여 최근 3년간 회비를 납부한 회원으로 아래 항목 중 적어도 한가지를 만족하는 회원
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>가.</span>
                                            <div>
                                                최근 5년간 게재된 논문(SCI 포함)이 10편 이상이고 동시에 대한환경공학회지 (국문 및 영문)에 게재된 논문이 5편 이상인 회원
                                            </div>
                                        </li>
                                        <li>
                                            <span>나.</span>
                                            <div>
                                                최근 3년간 본인이 개발한 기술로 국내 및 국제 관련 특허 혹은 신기술 인정을 획득한 회원
                                            </div>
                                        </li>
                                        <li>
                                            <span>댜.</span>
                                            <div>
                                                위 조건에 상응하는 업적을 갖춘 회원
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조 (피추천자의 선정) </strong>
                                <div>
                                    피추천자 후보군은 학술위원회 또는 동일한 기능을 수행하는 상임위원회에서 정하고 회장단에서 최종 선정한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">용역 오버헤드 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2000. 10. 27 제정 <br>
                            2007. 03. 23 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    본규정은 용역의 오버헤드에 관한 사항을 정함을 목적으로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조(용역 오버헤드 비율) </strong>
                                <div>
                                    본회 용역 오버헤드율은 다음과 같이 정한다.
                                    <ol class="list-type list-type-decimal">
                                        <li>
                                            학회에서 수주한 용역: 용역 총 금액의 15%
                                        </li>
                                        <li>
                                            개인이 수주한 용역: 용역 총 금액의 8%
                                        </li>
                                        <li>
                                            발주처 규정이 별도로 있는 경우, 그 규정에 따른다.
                                        </li>
                                    </ol>
                                </div>
                            </li>
                            <li>
                                <strong>부 칙 </strong>
                                <div>
                                    이 규정은 2007년 3월 23일부터 시행한다.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">대한환경공학회 연구윤리 규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2008. 06. 19 제정 <br>
                            2010. 02. 25 개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    본 연구윤리 규정은 대한환경공학회(이하 학회) 회원의 연구윤리를 확보하고 연구 부정행위를 방지하기 위하여 관련사항을 규정함을 원칙으로 한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조 (연구윤리규정 서약) </strong>
                                <div>
                                    본 회의 신규 회원은 본 연구윤리 규정을 준수하기로 서약해야 한다. 기존 회원은 윤리규정의 발효 시 윤리규정 준수를 서약한 것으로 간주한다.
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span> <div>논문의 저자는 자신이 행하지 않은 연구나 주장의 일부분을 자신의 연구 결과이거나 주장인 것처럼 논문이나 저술에 제시하지 않는다. 또한 공개된 학술 자료를 인용할 경우에는 출처를 명확히 밝혀야 한다.</div>
                                        </li>
                                        <li>
                                            <span>2)</span> <div>편집위원은 투고된 논문의 게재 여부를 결정함에 있어, 학술지 게재를 위해 투고된 논문을 어떤 선입견이나 사적인 친분과도 무관하게 오로지 논문의 질적 수준과 투고 규정에 근거하여 객관적인 평가가 이루어질 수 있도록 노력한다.</div>
                                        </li>
                                        <li>
                                            <span>3)</span> <div>심사위원은 학술지의 편집위원회가 의뢰하는 논문을 심사규정이 정한 기간 내에 성실하게 평가하고, 그 결과를 편집위원회에 통보한다. 만약 자신이 논문의 내용을 평가하기에 적임자가 아니라고 판단될 경우에는 편집위원회에 지체 없이 그 사실을 통보한다.</div>
                                        </li>
                                        <li>
                                            <span>4) </span><div>심사위원은 심사 대상 논문에 대한 비밀을 지켜야 한다. 또한 논문이 게재된 학술지가 출판되기 전에 저자의 동의 없이 논문의 내용을 인용하지아니한다.</div>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조 (윤리위원회 구성 및 임기)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                연구윤리위원회(이하 윤리위원회라 한다.)는 학회의 윤리에 관한 제반 사항 및 연구윤리규정에 위반되는 행위에 대하여 심의하고, 심의결과에 따라 필요한 조치사항을 결정한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>윤리위원회는 편집위원회 위원장 1인을 포함한 5인 이내의 위원으로 구성한다.</div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>윤리위원장은 편집위원회 위원장이 되며 위원은 위원장의 추천을 받아 학회 회장이 위촉한다.</div>
                                        </li>
                                        <li>
                                            <span>4)</span>
                                            <div>윤리위원이 심의대상자인 경우에는 당해 심의건에 대하여는 위원의 자격을 상실한다.</div>
                                        </li>
                                        <li>
                                            <span>5)</span>
                                            <div>위원의 임기는 2년으로 하되 단, 이사회 임원의 임기와 같이 한다.</div>
                                        </li>
                                        <li>
                                            <span>6)</span>
                                            <div>
                                                위원 중에서 결원이 생긴 때에는 지체 없이 후임위원을 위촉하며, 그 임기는 잔여기간으로 한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 4 조 (윤리위원회 기능)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                연구윤리 규정위반 여부 심의 및 필요한 규칙제정
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                제소된 사안에 대해 접수된 날로부터 60일 이내 심의·의결 처리
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                제소된 사안의 회원에 대해 제명, 자격정지, 공개사과 등 징계공포
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 5 조 (윤리위원회 회의)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                위원회 회의는 위원장이 소집하고 그 의장이 된다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                위원장은 회장 또는 위원 3인 이상의 요청이 있을 때에는 회의를 소집하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                회의는 다른 특별한 규정이 없는 한, 재적위원 3분의 2 이상의 출석으로 개최하며 출석위원 3분의 2 이상의 찬성으로 의결한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>4)</span>
                                            <div>
                                                의장은 서면으로 각 위원에게 회의안건 및 필요한 사항을 기재하여 적어도 회의개최일 7일 전에 통지하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>5)</span>
                                            <div>
                                                위원회의 회의와 의사록은 공개하지 아니한다. 단, 필요한 경우에는 위원회의 결정에 따라 의사록을 공개할 수 있다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 6 조 (연구부정행위의 대상) </strong>
                                <div>
                                    연구부정행위는 논문집, 학회지에 투고, 게재되는 논문을 대상으로 한다. 학회에 의뢰되는 연구용역에 의해 수행되는 연구결과물에 대해서도 논문에 준하여 적용한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 7 조 (위조 및 변조) </strong>
                                <div>
                                    위조나 변조는 다음과 같이 연구에 사용된 자료나 결과물의 수치, 사진 등을 의도적으로 진실과 다르게 표현 하는 행위를 포괄한다.
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                위조는 존재하지 않는 데이터 또는 연구결과 등을 허위로 만들어 내는 행위를 말한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                변조는 연구 과정 등을 인위적으로 조작하거나 데이터를 임의로 변형·삭제함으로써 연구 내용 또는 결과를 왜곡하는 행위를 말한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 8 조 (표절) </strong>
                                <div>
                                    표절은 고의적으로 국·내외 학술지, 학술대회 발표논문, 연구보고서, 석·박사학위논문, 서적, 잡지, 인터넷 등 모든 문자화된 매체를 통해 이미 발표된 학문적 아이디어, 견해, 표현, 연구결과 등의 내용을 출처표기 없이 기술하는 행위를 말한다.
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                표절은 연구자가 이미 발표된 논문의 저자와 동일한 경우(자기 표절)에도 적용된다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                단, 학계에서 이미 보편화되어 통용되고 있는 학문적 지식이나 연구결과 등에 대해서는 이를 인용 없이 기술하는 경우는 표절로 판단하지 않는다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 9 조 (중복투고 및 게재) </strong>
                                <div>
                                    표절은 고의적으로 국·내외 학술지, 학술대회 발표논문, 연구보고서, 석·박사학위논문, 서적, 잡지, 인터넷 등 모든 문자화된 매체를 통해 이미 발표된 학문적 아이디어, 견해, 표현, 연구결과 등의 내용을 출처표기 없이 기술하는 행위를 말한다.
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                이미 학술지에 게재된 논문을 중복게재 하는 것은 허용하지 않는다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                학술대회의 발표논문, 학위논문, 일반에게 공개되지 아니한 연구보고서 등을 학술지에 게재하는 것은 허용한다. 단, 이 경우에는 출처를 표기하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                동일논문을 서로 다른 학술지에 복수로 기고하는 것은 금지한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 10 조 (출처표기)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                학술대회 등에서 발표된 논문이나 그 일부를 그대로 또는 수정·보완하여 투고하는 경우에는 반드시 그 사실을 명기하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                연구보고서나 그 일부를 그대로 또는 수정·보완하여 투고하는 경우에는 반드시 그 사실을 명기하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                박사 또는 석사 학위논문이나 그 일부를 그대로 또는 수정·보완하여 투고하는 경우에는 반드시 학위논문의 작성자가 저자에 포함되어야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>4)</span>
                                            <div>
                                                공개된 학술 자료를 인용할 경우에는 정확하게 기술하도록 노력해야 하고, 상식에 속하는 자료가 아닌 한 반드시 그 출처를 명확히 밝혀야 한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 11 조 (연구 부정행위의 판정)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                학회 회원을 비롯하여 학회 내·외에서 연구 부정행위에 대한 제보가 있다면, 해당 편집위원회는 관련 자료를 취합하여 제보의 신빙성을 확인하여야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                편집위원회 위원장은 제보의 신빙성이 확인되면, 이를 윤리위원회에 안건으로 상정하고 심의자료를 제출한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                윤리위원회의 위원장은 심의에 앞서 상정된 안건에 대해 사전에 해당 연구자에게 문서로 소명할 기회를 부여한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>4)</span>
                                            <div>
                                                윤리위원회는 위원 3분의 2 이상 출석, 출석 위원 3분의 2 이상의 표결 동의로 연구 부정행위 여부를 판정하고, 그 결과를 학회장에게 건의한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>5)</span>
                                            <div>
                                                학회 회장은 연구윤리위원회의 의결 내용과 그 사유를 해당 연구자에게 통보한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 12 조 (이의제기)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                연구부정행위로 판정되는 연구자는 윤리위원회의 의결 내용이나 그 사유가 부당하다고 판단하는 경우, 통보일로부터 1개월 이내에 1회에 한하여 문서로 이의를 제기할 수 있다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                윤리위원회 위원장은 이의제기의 타당성을 즉시 검토하여 의결 내용을 재확인 하고, 2주일 내에 재심의할 수 있으며, 그 결과를 학회 회장에게 통보한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>3)</span>
                                            <div>
                                                학회 회장은 이의제기에 대한 윤리위원회의 의결 내용과 그 사유를 해당 연구자에게 통보한다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <strong>제 13 조 (비밀보장)</strong>
                                <div>
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>1)</span>
                                            <div>
                                                연구부정행위를 제보한 자의 신원을 외부에 공개해서는 안 된다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>2)</span>
                                            <div>
                                                연구부정행위로 최종 판정되기 전이나 연구부정행위가 아닌 것으로 판정되는 경우 해당 연구자의 신원을 외부에 공개해서는 안 된다.
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="term-tit">여비지급규정</div>
                    <div class="term-conbox">
                        <p class="mb-30">
                            2014. 05. 08 제정 <br>
                            2018. 04. 19개정
                        </p>
                        <ul class="list-type list-type-square">
                            <li>
                                <strong>제 1 조(목적) </strong>
                                <div>
                                    학회 이사회 참석 시 운임에 한해 여비를 지급할 수 있다.
                                </div>
                            </li>
                            <li>
                                <strong>제 2 조(지급기준) </strong>
                                <div>
                                    여비는 회의 개최지를 기준으로 개최지내 이동인 경우 1만원, 개최지 외 이동인 경우 KTX(일반실)운임요금을 기준으로 지급한다.
                                </div>
                            </li>
                            <li>
                                <strong>제 3 조(용어의 해석)</strong>
                                <div>
                                    제2조에서 "개최지 내 이동"이란 같은 시(특별시, 광역시 및 특별자치시를 포함한다. 이하 같다)·군 및 섬(제주특별자치도는 제외한다. 이하 같다) 안에서의 이동이나 여행거리가 12킬로미터 미만인 이동을 말한다
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- //e:규정 -->
        </div>
    </article>
@endsection

@section('addScript')
@endsection
