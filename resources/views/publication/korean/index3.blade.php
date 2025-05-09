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
                        <li ><a href="{{ route('publication.korean',['tab'=>2]) }}">편집위원장 인사말</a></li>
                        <li class="on"><a href="{{ route('publication.korean',['tab'=>3]) }}">편집위원회</a></li>
                        <li><a href="https://submit.kosenv.or.kr/" target="_blank">투고하기</a></li>
                    </ul>
                </div>
                <div class="table-wrap scroll-x touch-help">
                    <table class="cst-table">
                        <caption class="hide">편집위원회</caption>
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 15%;">
                            <col>
                            <col style="width: 20%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">직위</th>
                            <th scope="col">이름</th>
                            <th scope="col">소속</th>
                            <th scope="col">전문분야</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>편집</td>
                            <td rowspan="2">이원태</td>
                            <td rowspan="2">금오공과대학교</td>
                            <td rowspan="2">환경공학</td>
                        </tr>
                        <tr>
                            <td>위원장</td>
                        </tr>
                        <tr>
                            <td rowspan="17">편집위원 (국내)</td>
                            <td>경대승</td>
                            <td>울산대학교</td>
                            <td>에너지</td>
                        </tr>
                        <tr>
                            <td>김동훈</td>
                            <td>인하대학교</td>
                            <td>바이오</td>
                        </tr>
                        <tr>
                            <td>김상현</td>
                            <td>연세대학교</td>
                            <td>폐기물/자원순환</td>
                        </tr>
                        <tr>
                            <td>명재욱</td>
                            <td>한국과학기술원</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td>박성직</td>
                            <td>국립한경대학교</td>
                            <td>토양/지하수</td>
                        </tr>
                        <tr>
                            <td>박준규</td>
                            <td>조선대학교</td>
                            <td>폐기물/자원순환</td>
                        </tr>
                        <tr>
                            <td>안용태</td>
                            <td>경상국립대학교</td>
                            <td>에너지</td>
                        </tr>
                        <tr>
                            <td>우윤철</td>
                            <td>명지대학교</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td>이지이</td>
                            <td>이화여자대학교</td>
                            <td>대기</td>
                        </tr>
                        <tr>
                            <td>이창구</td>
                            <td>아주대학교</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td>정석희</td>
                            <td>전남대학교</td>
                            <td>에너지</td>
                        </tr>
                        <tr>
                            <td>정주형</td>
                            <td>국립군산대학교</td>
                            <td>폐기물/자원순환</td>
                        </tr>
                        <tr>
                            <td>정창훈</td>
                            <td>경인여자대학교</td>
                            <td>대기</td>
                        </tr>
                        <tr>
                            <td>조시경</td>
                            <td>동국대학교</td>
                            <td>바이오</td>
                        </tr>
                        <tr>
                            <td>조은혜</td>
                            <td>전남대학교</td>
                            <td>토양/지하수</td>
                        </tr>
                        <tr>
                            <td>최성득</td>
                            <td>울산과학기술원</td>
                            <td>대기</td>
                        </tr>
                        <tr>
                            <td>최용주</td>
                            <td>서울대학교</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td rowspan="6">편집위원 (국외)</td>
                            <td>Gopalakrishnan Kumar</td>
                            <td>University of Stavanger, Norway</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td>K. Chandrasekhar</td>
                            <td>Vignan university, India</td>
                            <td>수질 · 상하수도</td>
                        </tr>
                        <tr>
                            <td>Feng Qing</td>
                            <td>Qilu University of Technology, China</td>
                            <td>에너지</td>
                        </tr>
                        <tr>
                            <td>Hiroshi Yamamura</td>
                            <td>Chuo University, Japan</td>
                            <td>에너지</td>
                        </tr>
                        <tr>
                            <td>Guanlin Li</td>
                            <td>Jiangsu University, China</td>
                            <td>토양/지하수</td>
                        </tr>
                        <tr>
                            <td>Junbeum Kim</td>
                            <td>University of Technology of Troyes, France</td>
                            <td>LCA</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection
