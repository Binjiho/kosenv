<?php

$work_code = '202501';

return [
    'work_code' => "{$work_code}", // Workshop 코드
    'feeYear' => "2025", // 연회비 체크 연도

    'skin' => '202501', // Workshop 스킨
    'directory' => "/workshop/{$work_code}", // Workshop 업로드 경로
    'paginate' => 10, // 페이지별 노출 리스트 수

    'permission' => [ // 권한 빈값은 전체 접근, 값이있을경우 해당 level 만 접근가능
        'list' => [], // 리스트 권한
        'view' => [], // 상세보기 권한
        'write' => [], // 글쓰기 권한
    ],

    'use' => [ // 사용 유무
        'login' => false, // 로그인 필요
        'registration' => true, // 사전등록 사용
        'abstract' => true, // 초록 사용
        'support' => true, // 후원신청 사용
    ],

// ================= WORKSHOP Registration ===================
    'gubun' /*참가구분*/=> [
        'A'=>'참가자',
        'B'=>'YEP 발표자(포스터)',
        'C'=>'전문가그룹세션 발표자',
        'D'=>'특별세션 발표자',
        'E'=>'기업세션 발표자',
        'F'=>'외국인학술제 발표자(포스터)',
        'G'=>'외국인 학술제 참가자',
    ],
    'category' /*등록구분*/=> [
        'A'=>[
            'name'=>'회원(일반)',
            'price'=>'180000',
        ],
        'B'=>[
            'name'=>'회원(학생)',
            'price'=>'120000',
        ],
        'C'=>[
            'name'=>'회원(연회비 미납)',
            'price'=>'200000',
        ],
        'D'=>[
            'name'=>'비회원(일반)',
            'price'=>'200000',
        ],
        'E'=>[
            'name'=>'비회원(학생)',
            'price'=>'200000',
        ],
        'F'=>[
            'name'=>'외국인학술제(학생)',
            'price'=>'10000',
        ],
        'G'=>[
            'name'=>'외국인학술제(일반)',
            'price'=>'30000',
        ],
    ],

    'shuttle_yn' /*셔틀버스 수요조사*/=>[
        'Y'=>'예',
        'N'=>'아니오',
    ],

    'user_chk' /*환경공학회 홈페이지 회원여부*/=>[
        'Y'=>'회원',
        'N'=>'비회원',
    ],

    'payment_method' /*납부방법*/=>[
        'Card' => '신용카드',
        'DirectBank' => '실시간계좌이체',
//        'Free' => '무료'
    ],

    'payment_status' /*결제상태*/=>[
        'Y' => '결제완료',
        'N' => '결제미완료',
        'R' => '환불신청',
        'T' => '환불완료',
    ],

    'refund_method' /*환불방법*/=>[
        'C' => '카드취소',
        'D' => '계좌환불',
    ],
// ================= //WORKSHOP Registration =================

// ================= WORKSHOP Abstract ===================
    'topic' /*대주제*/=>[
        'A' => '대기환경',
        'B' => '생태 및 위해성',
        'C' => '물환경 / 상하수도',
        'D' => '자원순환 및 에너지',
        'E' => '토양 지하수',
        'F' => '환경정책 및 교육',
    ],

    'status' /*제출상태*/=>[
        'Y' => '최종제출',
        'N' => '입력진행중',
    ],
// ================= //WORKSHOP Abstract =================

// ================= WORKSHOP Support ===================
    'grade' /*구분*/=>[
        'D'=>[
            'name'=>'Diamond',
            'price'=>'2000000',
            'support' => false,
        ],
        'G'=>[
            'name'=>'Gold',
            'price'=>'1000000',
            'support' => false,
        ],
        'S'=>[
            'name'=>'Silver',
            'price'=>'0',
            'support' => true,
        ],
    ],

    'spay_method' /*결제방법*/=>[
        'Card' => '신용카드',
        'Bank' => '무통장입금',
    ],

    'spayment_status' /*결제상태*/=>[
        'Y' => '결제완료',
        'N' => '미입금',
    ],
// ================= //WORKSHOP Support =================

// ================= WORKSHOP GNB menu ===================
    'work_menu' => [
        'main' => [
            'M1' => [
                'name' => '행사안내',
                'route' => 'workshop.invite',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'M2' => [
                'name' => '프로그램',
                'route' => 'workshop.program',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'M3' => [
                'name' => '사전등록',
                'route' => 'registration.info',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'M4' => [
                'name' => '초록접수',
                'route' => 'abstract.info',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'M5' => [
                'name' => '후원',
                'route' => 'support.info',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'M6' => [
                'name' => '참가안내',
                'route' => 'workshop.directions',
                'param' => ['work_code'=>$work_code],
                'url' => null,
                'dev' => false,
                'continue' => false,
            ],
            'MYPAGE' => [
                'name' => '마이페이지',
                'route' => 'mypage.intro',
                'param' => [],
                'url' => '',
                'dev' => false,
                'continue' => true,
            ],
        ],

        'sub' => [
            'M1' => [ // 행사안내
                'S1' => [
                    'name' => '초대의 글',
                    'route' => 'workshop.invite',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S2' => [
                    'name' => '학술위원회',
                    'route' => 'workshop.committee',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S3' => [
                    'name' => '공지사항',
                    'route' => 'board',
                    'param' => ['code'=>'workshop-202501'],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'M2' => [ // 프로그램
                'S1' => [
                    'name' => '프로그램',
                    'route' => 'workshop.program',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'M3' => [ // 사전등록
                'S1' => [
                    'name' => '사전등록 안내',
                    'route' => 'registration.info',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S2' => [
                    'name' => '온라인 사전등록',
                    'route' => 'registration',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S3' => [
                    'name' => '사전등록 조회 및 영수증 출력',
                    'route' => 'registration.search',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'M4' => [ // 초록접수
                'S1' => [
                    'name' => 'YEP 초록접수 안내',
                    'route' => 'abstract.info',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S2' => [
                    'name' => 'YEP 초록접수',
                    'route' => 'abstract.check',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S3' => [
                    'name' => '초록접수 조회 및 수정',
                    'route' => 'abstract.search',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'M5' => [ // 후원
                'S1' => [
                    'name' => '후원 안내',
                    'route' => 'support.info',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S2' => [
                    'name' => '후원 신청',
                    'route' => 'support',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S3' => [
                    'name' => '후원 내역 조회',
                    'route' => 'support.search',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'M6' => [ // 참가안내
                'S1' => [
                    'name' => '오시는 길',
                    'route' => 'workshop.directions',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
                'S2' => [
                    'name' => '숙박안내',
                    'route' => 'workshop.accommodation',
                    'param' => ['work_code'=>$work_code],
                    'url' => null,
                    'continue' => false,
                ],
            ],
            'MYPAGE' => [ // 마이페이지
                'S1' => [
                    'name' => '마이페이지',
                    'route' => 'mypage.intro',
                    'param' => [],
                    'url' => null,
                    'continue' => false,
                ],
            ],
        ],
    ],
// ================= //WORKSHOP GNB menu =================
];
