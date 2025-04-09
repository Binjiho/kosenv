<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>대한환경공학회 전문가그룹 학술대회</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0;">
<table style="width:100%; max-width:650px; margin:0 auto; padding:0; border:1px solid #e2e2e2; border-collapse:collapse; border-spacing:0; text-align:left; color:#444;
        font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px; font-weight:400; letter-spacing:-0.5px; word-break:keep-all; box-sizing:border-box; ">
    <tbody>
    <tr>
        <td style="padding:0;">
            <img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/mail_header.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    <tr>
        <td style="padding:20px 50px; font-size:25px; font-weight:bold; letter-spacing:-1px; text-align:center; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4;">
            대한환경공학회 {{ $sup->workshop->subject ?? '' }}<br>
            후원접수 신청 완료 안내 드립니다. <br>
            (신청 비용 입금 요청)
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px 30px; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
            안녕하십니까?<br>
            {{ $sup->workshop->subject ?? '' }} 후원접수 신청 완료되어 안내 드립니다.<br><br>
            신청 비용 입금 요청 드리며, 입금 완료 시 최종 신청 완료되는 점 안내 드립니다.<br>
            입금 확인까지 최대 7일 정도 소요 될 수 있으며, 입금 완료 후 입금 완료 메일 발송 될 예정입니다.<br><br>
            문의사항이 있으신 경우 사무국으로 연락 부탁 드립니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0;  font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        접수번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->regnum ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        회사명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->company ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        대표자명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->ceo ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        사업장 주소
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        ({{ $sup->company_zipcode ?? '' }}) {{ $sup->company_address ?? '' }} {{ $sup->company_address2 ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 50px 0;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0;  font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        담당자명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->manager ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직급
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->position ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        소속 부서
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->department ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        우편물 수령지
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        ({{ $sup->manager_zipcode ?? '' }}) {{ $sup->manager_address ?? '' }} {{ $sup->manager_address2 ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        전화
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->tel ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        담당자 핸드폰
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->phone ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        FAX
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->fax ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        담당자 E-MAIL
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $sup->email ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 50px 0;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0;  font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        구분
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['grade'][$sup->grade]['name'] ?? '' }} -
                        {{ number_format($workshopConfig['grade'][$sup->grade]['price']) ?? '' }}원 (VAT없음)
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        금액
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ number_format($sup->price) ?? 0 }}원
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        결제 방법
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['spay_method'][$sup->spay_method] ?? '' }}
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:60px 0; text-align:center;">
            <a href="{{ env('APP_URL') }}/workshop/{{$sup->work_code}}/support/search" target="_blank"><img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/btn_mail_donation.png" alt=""></a>
        </td>
    </tr>
    <tr>
        <td style="padding:0; background-color: #3e5d66;">
            <img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/mail_footer.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>