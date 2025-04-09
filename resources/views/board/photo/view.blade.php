@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/gallery/assets/css/board.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:board -->
            <div id="board" class="board-wrap">
                <div class="board-view">
                    <div class="view-contop">
                        <h4 class="view-tit">
                            {{ $board->subject }}
                        </h4>
                        <div class="view-info text-center">
                            <span><strong>조회수 : </strong>{{ number_format($board->ref >> 0) }}</span>
                            <span><strong>게시일 : </strong>{{ $board->created_at->format('Y-m-d') }}</span>
                        </div>

                        <div class="view-info text-right">
                            <span><strong>행사 일자 : </strong>{{ $board->eventPeriod() }}</span>
                            <span><strong>행사 장소 : </strong>{{ $board->place ?? '' }}</span>
                        </div>
                    </div>
                    @if($boardConfig['use']['link'] && !empty($board->link_url))
                        <div class="view-link text-right">
                            <a href="{{ $board->link_url }}" target="_blank">{{ $board->link_url }}</a>
                        </div>
                    @endif

                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)
                    <div class="gall-view-wrap">
                        <img src="{{ $board->files[0]->realfile }}" id="big-img">

                        <a href="{{ $board->plDownloadUrl() }}" target="_blank" class="btn-img-down" title="사진 다운로드">
                            <img src="/html/bbs/gallery/assets/image/ic_gall_down.png" alt="">
                        </a>
                    </div>

                    <div class="gall-rolling-wrap">
                        <div class="gall-cnt-wrap">
                            <strong class="current">1</strong>
                            <span class="total">5</span>
                        </div>

                        <button type="button" class="btn-gall btn-gall-prev"><span class="hide">이전</span></button>
                        <button type="button" class="btn-gall btn-gall-next"><span class="hide">다음</span></button>

                        <div class="gall-view-rolling">
                            <div class="js-view-rolling">
                                @php($rollingPage = 1)

                                @foreach($board->files as $file)
                                    @if($rollingPage == 1)
                                        <div class="gall-view-con">
                                            @endif

                                            <a href="javascript:void(0);">
                                                <img src="{{ $file->realfile }}" alt="">
                                            </a>

                                            @if($loop->last || $rollingPage == 10)
                                        </div>
                                        @php($rollingPage = 1)
                                    @else
                                        @php($rollingPage++)
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="view-contents editor-contents">
                        @if($boardConfig['use']['contents'] && !empty($board->contents))
                            {!! $board->contents !!}
                        @endif
                    </div>

                    <div class="btn-wrap text-right">
                        @if(isAdmin() || thisPk() == $board->user_sid)
                        <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-type1 color-type10">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 color-type7 btn-delete">삭제</a>
                        @endif
                        <a href="{{ route('board', ['code' => $code]) }}"  class="btn btn-type1 color-type6">목록</a>
                    </div>
                </div>
            </div>
            <!-- //e:board -->

        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    <script>
        $(function(e){
            if($('.js-view-rolling').length){
                $('.js-view-rolling').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $('.gall-cnt-wrap .total').text(slick.slideCount);
                    $('.gall-cnt-wrap .current').text(i);
                });
                $('.js-view-rolling').not('.slick-initialized').slick({
                    arrows: true,
                    prevArrow: $('.btn-gall-prev'),
                    nextArrow: $('.btn-gall-next'),
                    dots: false,
                    autoplay: false,
                    autoplaySpeed: 3000,
                    speed: 1000,
                    infinite: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                });
                $('.js-view-rolling .gall-view-con > a').each(function(e){
                    $(this).on('click',function(e){
                        var imgLink = $(this).children('img').attr('src');
                        $('#big-img').attr('src',imgLink);
                        $('#big-img').next('a').attr('href',imgLink);
                        return false;
                    });
                });
            }
        });
    </script>

    @if(isAdmin() || thisPK() == $board->user_sid)
        <script>
            $(document).on('click', '.btn-delete', function() {
                if (confirm('삭제 하시겠습니까?')) {
                    callAjax(dataUrl, { case: 'board-delete', sid: {{ $board->sid }} });
                }
            });
        </script>
    @endif
@endsection
