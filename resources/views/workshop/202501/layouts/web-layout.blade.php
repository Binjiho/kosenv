<!DOCTYPE html>
<html lang="ko">
<head>
    @include('workshop.'.$work_code.'.'.'layouts.components.baseHead')
</head>
<body>

<div class="wrap {{ ($main_menu ?? '') == 'main' ? "main" : "sub" }}">

    @include('workshop.'.$work_code.'.'.'layouts.include.header')

    <section id="container" >

        @yield('contents')

    </section>

    @include('workshop.'.$work_code.'.'.'layouts.include.footer')

</div>

@include('workshop.'.$work_code.'.'.'layouts.components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
