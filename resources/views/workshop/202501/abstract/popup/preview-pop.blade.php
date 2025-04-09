@extends('workshop.'.$work_code.'.'.'layouts.popup-layout')

@section('addStyle')
@endsection

@section('contents').

<article class="sub-contents">
    <div class="sub-conbox inner-layer">

        <div class="pc-only-wrap m-show">
            <img src="/target/202501/assets/image/sub/img_pc_only.png" alt="">
            <p>YEP 초록접수는 <span>PC</span>에서만 가능합니다.</p>
        </div>

        <div class="m-hide">
            <form id="regFrm" method="post" action="{{ route('abstract.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($abs->sid) ? $abs->sid : '' }}" data-case="abstract-complete">

                <fieldset>
                    <legend class="hide">초록접수 미리보기</legend>
                    @include('workshop.'.$work_code.'.'.'abstract.form.preview-frm')
                </fieldset>

                <div class="btn-wrap text-center">
                    @if($isAbsDue)
                    <a href="javascript:;" class="btn btn-type1 color-type2" id="modify">수정하기</a>
                    @endif
                    <a href="javascript:self.close();" class="btn btn-type1 color-type4">취소</a>
                </div>

            </form>
        </div>
    </div>
</article>

@endsection

@section('addScript')
    <script>
        $(document).on('click','#modify',function(){
            window.opener.location.href = '{{ route('abstract',['work_code'=>$work_code,'sid'=>$abs->sid]) }}';
            window.close();
        });
    </script>
@endsection
