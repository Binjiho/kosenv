<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>대한환경공학회 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0;">
<table style="width:100%; max-width:650px; margin:0 auto; padding:0; border:1px solid #e2e2e2; border-collapse:collapse; border-spacing:0; text-align:center;
        font-family:'맑은 고딕',Arial,sans-serif; line-height:1.4; font-size:15px; font-weight:400; letter-spacing:-0.5px; word-break:keep-all; box-sizing:border-box; ">
    <tbody>
    <tr>
        <td style="padding:0;">
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_header.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    <tr>
        <td style="padding:50px 30px 0; font-size:30px; font-weight:bold; color:#90c31f; letter-spacing:-1.5px; ">
            대한환경공학회 홈페이지 임시 비밀번호 안내 드립니다.
        </td>
    </tr>
    <tr>
        <td style="padding:30px 30px 0; color:#4d4d4d; font-size:17px; font-weight:400; text-align: center;">
            {{ $user->name_kr ?? '' }} 회원님. 문의하신 임시 비밀번호 정보 입니다.<br>
            임시 비밀번호로 로그인하신 후 원하시는 비밀번호로 수정해서 이용하시기 바랍니다.
        </td>
    </tr>
    <tr>
        <td style="padding:35px 50px;">
            <table style="width:100%; border-collapse:collapse; border-spacing:0;">
                <colgroup>
                    <col style="width:200px;">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row" style="padding:12px 20px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2;
                                    text-align:left; font-size:15px; font-weight:400;">
                        아이디
                    </th>
                    <td style="padding:12px 20px; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; border-left:1px solid #e2e2e2;
                                    text-align:left; font-size:15px; font-weight:400;">
                        {{ $user->id ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" style="padding:12px 20px; background-color:#f4f4f4; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2;
                                    text-align:left; font-size:15px; font-weight:400;">
                        임시비밀번호
                    </th>
                    <td style="padding:12px 20px; border-top:1px solid #e2e2e2; border-bottom:1px solid #e2e2e2; border-left:1px solid #e2e2e2;
                                    text-align:left; font-size:15px; font-weight:400;">
                        {{ $tempPassword ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:0 0 180px;">
            <a href="{{ env('APP_URL') }}/" target="_blank"><img src="{{ env('APP_URL') }}/assets/image/mail/btn_mail_home.png" alt=""></a>
        </td>
    </tr>
    <tr>
        <td style="padding:0 30px 40px; text-align:left; color:red; font-size:15px; font-weight:400;">
            ※ 정보 유출 방지를 위하여 메일을 확인 하신 후 삭제 하시기 바랍니다.
        </td>
    </tr>
    <tr>
        <td style="padding:0; background-color: #3a3e49;">
            <img src="{{ env('APP_URL') }}/assets/image/mail/mail_footer.png" alt="" style="display:block; margin:0 auto;">
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>