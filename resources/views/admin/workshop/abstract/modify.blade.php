@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="/target/202501/assets/css/common.css">

    <style>
        .cst input[type="checkbox"] {
            appearance: none;
            position: relative;
            width: 16px;
            height: 16px;
            margin-top: -5px;
            margin-right: 5px;
            border: 2px solid #bfbfbf;
            transition: 0.3s ease;
            cursor: pointer;
            vertical-align: middle;
        }
        .cst input[type="checkbox"] {
            border-radius: 3px;
            border-color: #bfbfbf;
            background-position: center;
        }

        .cst input[type="checkbox"]:checked::before {
            content: '';
            position: absolute;
            top: 0;
            left: 25%;
            display: block;
            height: 70%;
            width: 30%;
            transform: rotate(50deg);
            border-right: 2px solid #0096da;
            border-bottom: 2px solid #0096da;
        }

        .cst input[type="checkbox"]:checked {
            border-color: #0096da;
        }
    </style>
@endsection

@section('contents')
    <form id="register-frm" method="post" action="{{ route('abstract.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($abs->sid) ? $abs->sid : '' }}" data-case="abstract-update">
        <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
        <input type="hidden" name="status" id="status" value="{{ $abs->status ?? '' }}" readonly>

        <fieldset>
            @include('workshop.'.$work_code.'.'.'abstract.form.regist-frm')

        </fieldset>

        <div class="btn-wrap text-center">
            <a href="javascript:;" id="post" class="btn btn-type1 color-type4 btn-line">수정하기</a>
            <a href="javascript:self.close();" class="btn btn-type1 color-type4">취소</a>
        </div>
    </form>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('abstract.data',['work_code'=>$work_code]) }}';

        const boardSubmit = () => {
            // if($("#agree1").is(":checked") == false){
            //     alert('개인정보 수집 및 이용 동의에 동의해주세요.');
            //     return false;
            // }
            // if($("#agree2").is(":checked") == false){
            //     alert('개인정보 제3자 제공에 동의해주세요.');
            //     return false;
            // }

            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('abs-script')
@endsection
