
    <div class="write-wrap preview-wrap  n-bd" style="{{ strpos(request()->getUri(),'pop') !== false ? 'margin-top:0px;' :'' }}">
        <div class="write-wrap-top">
            <p class="tit">Preview</p>
        </div>
        <div class="preview-conbox">
            <p class="subject">[{{ $workshopConfig['topic'][$abs->topic] ?? '' }}]</p>
            <p class="title">{{ $abs->title_kr ?? '' }}</p>
            <p class="title-eng">{{ $abs->title_en ?? '' }}</p>
            <p class="author">
                @foreach($abs->authors as $key => $val)
                    @if(!empty($val->affiliation))
                    {{ $val->name_kr ?? '' }}<sup>{{ implode(' ',$val->affiliation) }}</sup>
                    @endif
                    @if(!$loop->last)·@endif
                @endforeach
                <br>
                @foreach($abs->authors as $key => $val)
                    @if(!empty($val->affiliation))
                    {{ $val->first_name ?? '' }} {{ $val->last_name ?? '' }}<sup>{{ implode(' ',$val->affiliation) }}</sup>
                    @endif
                    @if(!$loop->last)·@endif
                @endforeach
            </p>
            <p class="author">
                @foreach($abs->affiliations as $key => $val)
                    <sup>{{ $key+1 }}</sup>{{ $val->affi_kr ?? '' }}
                    @if(!$loop->last)·@endif
                @endforeach
                <br>
                @foreach($abs->affiliations as $key => $val)
                    <sup>{{ $key+1 }}</sup>{{ $val->affi_en ?? '' }}
                    @if(!$loop->last)·@endif
                @endforeach
            </p>
            <div class="contents">
                <dl>
                    <dt>초록 (Abstract)</dt>
                    <dd>
                        <div>{!! $abs->contents ?? '' !!}</div>
                    </dd>
                </dl>
                <dl>
                    <dt>주제어 (Keywords)</dt>
                    <dd>
                        <div>{{ $abs->keyword1 ?? '' }} {{ $abs->keyword2 ? ', '.$abs->keyword2 : '' }} {{ $abs->keyword3 ? ', '.$abs->keyword3 : '' }} {{ $abs->keyword4 ? ', '.$abs->keyword4 : '' }} {{ $abs->keyword5 ? ', '.$abs->keyword5 : '' }}</div>
                    </dd>
                </dl>
                <dl>
                    <dt>사사 (Acknowledgment)</dt>
                    <dd>
                        <div>{{ $abs->ack ?? '' }}</div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>