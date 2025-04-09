@php
    $main_name = $work_menu['main'][$main_menu]['name'] ?? '';
    if(!empty($sub_menu)){
        $sub_name = $work_menu['sub'][$main_menu][$sub_menu]['name'] ?? '';
    }
@endphp

<article class="sub-visual">
    <div class="sub-visual-con inner-layer">
        @if(!empty($sub_menu))
        <p>{{ $sub_name }}</p>
        @endif
    </div>
</article>

<article class="sub-menu-wrap">
    <div class="sub-menu">
        <ul class="sub-menu-list js-sub-menu-list cf">
            <li class="sub-menu-depth01">
                <a href="javascript:;" class="btn-sub-menu js-btn-sub-menu">{{ $main_name }}</a>
                <ul>
                    @foreach($work_menu['main'] ?? [] as $key => $val)
                        @if($val['continue']) @continue @endif
                        <li class="{{ ($main_menu ?? '') == $key ? 'on':'' }}"><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" >{{ $val['name'] }}</a></li>
                    @endforeach
                </ul>
            </li>

            @if($work_menu['sub'][$main_menu][$sub_menu])
                <li class="sub-menu-depth02">
                    <a href="javascript:;" class="btn-sub-menu js-btn-sub-menu">{{ $sub_name }}</a>
                    <ul>
                        @foreach($work_menu['sub'][$main_menu] ?? [] as $sKey => $sVal)
                            @if($sVal['continue']) @continue @endif
                            <li class="{{ ($sub_menu ?? '') == $sKey ? 'on':'' }}"><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}" >{{ $sVal['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>

        <ul class="breadcrumb">
            <li><img src="/target/202501/assets/image/sub/img_breadcrumb.png" alt=""></li>
            <li>HOME</li>
            <li class="font-suit">&gt;</li>
            <li>{{ $main_name }}</li>
            @if(!empty($sub_menu))
            <li class="font-suit">&gt;</li>
            <li>{{ $sub_name }}</li>
            @endif
        </ul>
    </div>
</article>