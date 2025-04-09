<!DOCTYPE html>
<html lang="ko">
<head>
    @include('workshop.'.$work_code.'.'.'layouts.components.baseHead')
</head>
<body>
    @yield('contents')

    @include('layouts.components.spinner')

    {{--addScript--}}
    @yield('addScript')
</body>
</html>
