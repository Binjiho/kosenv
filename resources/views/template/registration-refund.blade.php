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
            대한환경공학회 {{ $reg->workshop->subject ?? '' }} <br>
            환불 신청 접수 안내 드립니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px 30px; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
            {{ $reg->name_kr ?? '' }} 회원님. 안녕하십니까? <br>
            {{ $reg->workshop->subject ?? '' }} 사전등록 환불 신청 접수 안내 메일 드립니다. <br><br>
            환불 신청이 접수되면 사전 등록이 자동으로 취소되며, 해당 환불 신청은 번복할 수 없습니다.<br>
            환불 처리는 최대 7일이 소요될 수 있으며, 신용카드 결제 취소의 경우 카드사별 정책에 따라 추가적인 시간이 필요할 수 있습니다.<br>
            환불 신청 완료 후 재등록을 원하시는 경우, 신규 사전 등록 절차를 다시 진행해 주시기 바랍니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0 50px;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
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
                        {{ $reg->regnum ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        성명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->name_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        직장명 (소속)
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->sosok_kr ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        이메일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->email ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        등록비
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['category'][$reg->category]['price'] ? number_format($workshopConfig['category'][$reg->category]['price']): '' }}원
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        결제 방법
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['payment_method'][$reg->payment_method] ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        최종 등록일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->complete_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        환불 사유
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->refund_reason ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        환불 방법
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $workshopConfig['refund_method'][$reg->refund_method] ?? '' }}
                    </td>
                </tr>
                @if(($reg->refund_method ?? '') == 'D')
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        환불 계좌 은행 명
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->refund_bank ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        환불 계좌번호
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->refund_num ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        예금주
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->account_name ?? '' }}
                    </td>
                </tr>
                @endif
                <tr>
                    <th scope="row" style="padding:10px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; font-weight:400; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        환불 신청일
                    </th>
                    <td style="padding:10px; border:1px solid #e2e2e2; border-right:0; text-align:left; font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px;">
                        {{ $reg->refund_at ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:60px 0; text-align:center;">
            <a href="{{ env('APP_URL') }}/workshop/{{$reg->work_code}}/registration/search" target="_blank"><img src="{{ env('APP_URL') }}/target/202501/assets/image/mail/btn_mail_home.png" alt=""></a>
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