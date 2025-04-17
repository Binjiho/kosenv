<div class="popup-wrap" style="display: block;">
    <div class="popup-rolling-wrap js-popup-rolling n3 inner-layer">
        @foreach($boardPopupList as $board /* 게시판 팝업 */)
            @php($popup = $board->popups)

            @switch($board->popups->popup_skin)
                @case('0')
                    <div class="popup-contents type4" id="board-popup-{{ $board->sid }}">
                        <div class="scroll-y">
                            <div class="popup-conbox">
                                <div class="popup-contit-wrap">
                                    <h2 class="popup-contit">{{ $board->subject }}</h2>
                                </div>

                                <div class="popup-con">
                                    {!! $popup->popup_contents !!}
                                </div>

                                @if(($board->files_count ?? 0) > 0)
                                    <div class="popup-attach-con">
                                        @foreach($board->files as $key => $file)
                                            <a href="{{ empty($preview) ? $file->downloadUrl() : "javascript:void(0);" }}">
                                                {{ $file->filename }} (다운로드 : {{ number_format($file->download) }}회)
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="btn-wrap text-center">
                                    @if(!empty($popup->popup_link))
                                        <a href="{{ $popup->popup_link }}" class="btn btn-pop-more">자세히보기</a>
                                    @endif

                                    @if(!empty($board->link_url))
                                        <a href="{{ $board->link_url }}" class="btn btn-pop-link">바로가기</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="popup-footer btn-pop-today-close" style="cursor: pointer;">
                            [오늘하루 그만보기]
                        </div>

                        <button type="button" class="btn btn-pop-close">
                            <span class="hide">팝업 닫기</span>
                        </button>
                    </div>
                    @break

                @case('1')
                    <div class="popup-contents type3" id="board-popup-{{ $board->sid }}">
                        <div class="popup-tit-wrap">
                            <img src="/assets/image/popup/popup_logo.png" alt="">
                        </div>
                        <div class="scroll-y">
                            <div class="popup-conbox">
                                <div class="popup-contit-wrap">
                                    <h2 class="popup-contit">{{ $board->subject }}</h2>
                                </div>

                                <div class="popup-con">
                                    {!! $popup->popup_contents !!}
                                </div>

                                @if(($board->files_count ?? 0) > 0)
                                    <div class="popup-attach-con">
                                        @foreach($board->files as $key => $file)
                                            <a href="{{ empty($preview) ? $file->downloadUrl() : "javascript:void(0);" }}">
                                                {{ $file->filename }} (다운로드 : {{ number_format($file->download) }}회)
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="btn-wrap text-center">
                                    @if(!empty($popup->popup_link))
                                        <a href="{{ $popup->popup_link }}" class="btn btn-pop-more">자세히보기</a>
                                    @endif

                                    @if(!empty($board->link_url))
                                        <a href="{{ $board->link_url }}" class="btn btn-pop-link">바로가기</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="popup-footer btn-pop-today-close" style="cursor: pointer;">
                            [오늘하루 그만보기]
                        </div>

                        <button type="button" class="btn btn-pop-close">
                            <span class="hide">팝업 닫기</span>
                        </button>
                    </div>
                    @break

                @default
                    @break
            @endswitch
        @endforeach
    </div>
</div>

<script>
    $(function(e){
        popupRolling();
        $(window).resize(function(e){
            popupRolling();
        });
    });

    function popupRolling(){
        // $('.js-pop-close').each(function(e){
        //     $(this).on('click',function(e){
        //         $(this).parents('.popup-contents').remove();
        //     });
        // });

        if ($('.js-popup-rolling .popup-contents').length === 0) {
            $('.popup-rolling-wrap').closest('.popup-wrap').remove();
        }

        if($('.js-popup-rolling .popup-contents').length > 1){
            if($('.js-popup-rolling').hasClass('n3')){
                var $setting = '',
                    $num1 = 3,
                    $num2 = 1;
            }else{
                var $setting = 'unslick',
                    $num1 = '',
                    $num2 = '';
            }

            $('.js-popup-rolling').not('.slick-initialized').slick({
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 3000,
                speed: 1000,
                infinite: false,
                adaptiveHeight: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 9999,
                    settings: $setting,
                    slidesToShow: $num1,
                    slideToScroll: $num1,
                },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }]
            });
        }
    }

    function setCookie24(name, value, expiredays) {
        var todayDate = new Date();

        todayDate.setDate(todayDate.getDate() + expiredays);

        document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";";
    }

    $(document).on('click', '.btn-pop-close', function () {
        $(this).closest('.popup-contents').remove();
        popupRolling();
    });

    $(document).on('click', '.btn-pop-today-close', function () {
        const layer = $(this).closest('.popup-contents');

        setCookie24(layer.attr('id'), 'done', 1);

        layer.remove();

        popupRolling();
    });
</script>