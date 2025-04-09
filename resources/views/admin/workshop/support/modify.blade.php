@extends('admin.layouts.popup-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="/target/202501/assets/css/common.css">
@endsection

@section('contents')
    <form id="register-frm" method="post" action="{{ route('support.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($sup->sid) ? $sup->sid : '' }}" data-case="support-update">
        <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
        <input type="hidden" name="status" id="status" value="{{ $sup->status ?? '' }}" readonly>
        <input type="hidden" name="price" id="price" value="{{ $sup->price ?? 0 }}" readonly>

        <fieldset>
            @include('workshop.'.$work_code.'.'.'support.form.regist-frm')

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
        const dataUrl = '{{ route('support.data',['work_code'=>$work_code]) }}';

        const boardSubmit = () => {
            let ajaxData = newFormData(form);

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

    @yield('support-script')
@endsection
