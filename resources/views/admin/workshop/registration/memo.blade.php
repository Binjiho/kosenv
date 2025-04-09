@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
        .write-wrap:has(.preview-wrap) {
            margin-top: 60px !important;
        }
    </style>
@endsection

@section('contents')
    <div style="padding: 25px;">
        <div class="write-form-wrap">
            <form id="memo-frm" method="post" data-sid="{{ $reg->sid }}" data-case="memo-write">

                <div class="write-wrap">
                    <dl>
                        <dd>
                            <textarea name="admin_memo" id="admin_memo" cols="30" rows="10" style="resize: none; border: 1px solid black; padding: 10px;">{{ $reg->admin_memo }}</textarea>
                        </dd>
                    </dl>
                </div>

                <div class="btn-wrap text-center">
                    <a href="javascript:window.close();" class="btn btn-type1 color-type3">취소</a>
                    <button type="submit" class="btn btn-type1 btn-line color-type4">{{ empty($reg->admin_memo) ? '등록' : '수정' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#memo-frm';
        const dataUrl = '{{ route('registration.data',['work_code'=>$work_code]) }}';

        $(document).on('submit', form, function () {
            callAjax(dataUrl, formSerialize(form));
        });
    </script>
@endsection
