@if(empty($abs->sid))
    <tr class="target-affiliation" >
        {{--    <input type="hidden" name="affiliation_sid[]" value="{{ $row->sid ?? '' }}">--}}
        <input type="hidden" name="affiliation_ord[]" value="{{ ($eq ?? 1) }}">
        <th class="text-center affiliation-eq">{{ ($eq ?? 1) }}</th>
        <td>
            <div class="form-group-text">
                <p class="text">국문 :</p>
                <input type="text" name="affi_kr[]" value="" class="form-item" onlyKo>
            </div>
            <div class="form-group-text mt-10">
                <p class="text">영문 :</p>
                <input type="text" name="affi_en[]" value="" class="form-item" noneKo>
            </div>
        </td>
        <td>
            <div class="btn-wrap mt-0 text-center">
                <a href="javascript:;" onclick="move_order(this,'up');" class="btn btn-small color-type1 btn-line font-suit">▲</a>
                <a href="javascript:;" onclick="move_order(this,'down');" class="btn btn-small color-type1 btn-line font-suit">▼</a>
                @if(($eq ?? 1) != 1)
                    <a href="javascript:;" class="btn btn-small color-delete affiliation-delete">삭제</a>
                @endif
            </div>
        </td>
    </tr>
@else
    @forelse($abs->affiliations as $key => $row)
    <tr class="target-affiliation" data-sid="{{ $row->sid ?? '' }}">
    {{--    <input type="hidden" name="affiliation_sid[]" value="{{ $row->sid ?? '' }}">--}}
        <input type="hidden" name="affiliation_ord[]" value="{{ ($eq ?? 1) }}">
        <th class="text-center affiliation-eq">{{ $key+1 ?? ($eq ?? 1) }}</th>
        <td>
            <div class="form-group-text">
                <p class="text">국문 :</p>
                <input type="text" name="affi_kr[]" value="{{ $row->affi_kr ?? '' }}" class="form-item" onlyKo>
            </div>
            <div class="form-group-text mt-10">
                <p class="text">영문 :</p>
                <input type="text" name="affi_en[]" value="{{ $row->affi_en ?? '' }}" class="form-item" noneKo>
            </div>
        </td>
        <td>
            <div class="btn-wrap mt-0 text-center">
                <a href="javascript:;" onclick="move_order(this,'up');" class="btn btn-small color-type1 btn-line font-suit">▲</a>
                <a href="javascript:;" onclick="move_order(this,'down');" class="btn btn-small color-type1 btn-line font-suit">▼</a>
                @if( $key ?? ($eq ?? 1) != 1)
                    <a href="javascript:;" class="btn btn-small color-delete affiliation-delete">삭제</a>
                @endif
            </div>
        </td>
    </tr>
    @empty
    @endforelse
@endif
