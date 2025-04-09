@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="{{ asset('html/bbs/vod/assets/css/board.css') }}">
@endsection

@section('contents')
    @include('layouts.include.sub-menu-wrap')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <!-- s:board -->
            <div class="sch-wrap type3 skin3">
                <form action="{{ route('board', ['code' => $code]) }}" method="get">
                    <feildset>
                        <legend class="hide">검색</legend>
                        <div class="form-group">
                            <select name="search" class="form-item sch-cate">
                                @foreach($boardConfig['search'] as $key => $val)
                                    <option value="{{ $key }}" {{ (request()->search ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="keyword" class="form-item sch-key" placeholder="검색어를 입력하세요." value="{{ request()->keyword ?? '' }}">
                            <button type="submit" class="btn btn-sch">검색</button>
                        </div>
                    </feildset>
                </form>
            </div>

            <div id="board" class="board-wrap">
                <!-- mobile 2column class="n2" -->
                <ul class="vod-list">
                    @forelse($list as $row)
                    <li class="ef03" data-sid="{{ $row->sid ?? 0 }}">
                        <a href="{{ !empty($row->link_url) ? $row->link_url : 'javascript:;' }}" {{ !empty($row->link_url) ? 'target="_blank"' : '' }} >
                            <div class="gall-img">
                                <img src="{{ empty($row->thumbnail_realfile) ? '/html/bbs/vod/assets//image/no_image.png' : asset($row->thumbnail_realfile) }}" alt="">
                            </div>
                            <div class="gall-text">
                                <div class="gall-tit-wrap">
                                    <p class="gall-tit ellipsis2">
                                        {{ $row->subject }}

                                        {!! $row->isNew() !!}
                                    </p>
                                </div>
                                <div class="gall-con">
                                    <span class="gall-date">{{ $row->created_at->format('Y-m-d') }}</span>
                                    <span class="gall-name">{{ $row->name ?? '' }}</span>
                                    <span class="gall-hit">{{ number_format($row->ref) }} Hit</span>
                                </div>
                            </div>
                        </a>
                        @if(isAdmin())
                            <div class="bbs-admin">
                                <select name="hide" class="form-item">
                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ $key == $row->hide ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('board.upsert', ['code' => $row->code, 'sid' => $row->sid]) }}" class="btn btn-modify">
                                    <span class="hide">수정</span>
                                </a>

                                <a href="javascript:void(0);" class="btn btn-delete">
                                    <span class="hide">삭제</span>
                                </a>
                            </div>
                        @endif
                    </li>
                    @empty
                    <!-- no data -->
                    <li class="no-data">
                        <img src="/html/bbs/notice/assets/image/ic_nodata.png" alt=""> <br>
                        등록된 게시글이 없습니다.
                    </li>
                    @endforelse
                </ul>


                @if(isAdmin())
                    <div class="btn-wrap text-right">
                        <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-board color-type9">등록</a>
                    </div>
                @endif

                <div class="paging-wrap">
                    {{ $list->links('pagination::custom') }}
                </div>
            </div>
            <!-- board -->

        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    @if(isAdmin())
        <script>
            $(document).on('change', 'select[name=hide]', function() {
                const ajaxData = {
                    case: 'db-change',
                    sid: getPK(this),
                    column: 'hide',
                    value: $(this).val(),
                }

                callAjax(dataUrl, ajaxData);
            });

            $(document).on('click', '.btn-delete', function() {
                const ajaxData = {
                    case: 'board-delete',
                    sid: getPK(this),
                }

                if (confirm('삭제 하시겠습니까?')) {
                    callAjax(dataUrl, ajaxData);
                }
            });
        </script>
    @endif
@endsection
