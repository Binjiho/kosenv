@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
        .resend-input {
            border: 1px solid black;
            width: 100%;
            height: 35px;
            padding: 5px;
        }
    </style>
@endsection

@section('contents')
    <div style="padding: 30px; padding-bottom: 50px;">
        @include('template.abstract-ok')

        <form id="resend-frm" method="post" data-sid="{{ $abs->sid }}" data-case="resend-mail" style="margin-top: 65px;">
            <fieldset>
                <div class="sub-tit-wrap">
                    <h3 class="sub-tit">초록등록 메일 재발송</h3>
                    <p class="help-text">
                    ※ 발송 이메일 입력하지 않고 메일 발송 버튼 클릭 시 해당 등록자에게 메일이 발송됩니다.
                    </p>
                    <p class="help-text">
                        ※ 발송 이메일 입력 후 메일 발송 클릭 시 입력한 메일 계정으로만 해당 초록등록 메일이 발송됩니다.
                    </p>
                </div>

                <table class="cst-table">
                    <colgroup>
                        <col style="width: 20%;">
                        <col>
                        <col style="width: 20%;">
                    </colgroup>

                    <tbody>
                    <tr>
                        <td>발송 이메일</td>
                        <td>
                            <input type="text" name="email" id="email" class="resend-input">
                        </td>
                        <td>
                            <div class="btn-wrap text-center">
                                <button type="button" class="btn btn-type1 color-type4" id="resend">메일 발송</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('abstract.data',['work_code'=>request()->work_code]) }}';
        const form = '#resend-frm';

        $(document).on('click', '#resend', function () {
            const email = $('#email').val();

            // if ( isEmpty(email) ) {
            //     alert('이메일을 입력해주세요.');
            //     $('#email').focus();
            //     return false;
            // }

            if (!isEmpty(email) && !emailCheck(email)) {
                alert('올바른 이메일 형식이 아닙니다.');
                $('#email').focus();
                return false;
            }

            callAjax(dataUrl, formSerialize(form));
        });
    </script>
@endsection
