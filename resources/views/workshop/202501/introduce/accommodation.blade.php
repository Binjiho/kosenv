@extends('workshop.'.$work_code.'.'.'layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('workshop.'.$work_code.'.'.'layouts.include.sub-menu-wrap')
    
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('workshop.'.$work_code.'.'.'layouts.not_page')
        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
