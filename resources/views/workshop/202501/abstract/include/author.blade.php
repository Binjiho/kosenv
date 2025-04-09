@if(empty($abs->sid))
    <tr class="target-author" data-sid="">
        <input type="hidden" name="author_ord[]" value="{{ ($eq ?? 1) }}">
        <th class="text-center author-eq">{{ ($eq ?? 1) }}</th>
        <td>
            <div class="form-group-text">
                <p class="text">국문 :</p>
                <input type="text" name="name_kr[]" value="" class="form-item" onlyKo>
            </div>
            <div class="form-group-text mt-10">
                <p class="text">영문 :</p>
                <input type="text" name="first_name[]" value="" class="form-item" placeholder="First Name" noneKo>
                <input type="text" name="last_name[]" value="" class="form-item" placeholder="Last Name" noneKo>
            </div>
        </td>
        <td>
            <div class="checkbox-wrap cst">
                @for($i = 1; $i <= $maxAddCnt; $i++)
                    <div class="checkbox-group affiliation-checkbox" style="display: {{ ($affiliations_count ?? 1) >= $i ? 'inline-block' : 'none' }}">
                        <input type="checkbox" name="affiliation_check_{{ ($eq ?? 1) }}[]" id="affiliation_check_{{ ($eq ?? 1) }}_{{ $i }}" value="{{ $i }}" >
                        <label for="affiliation_check_{{ ($eq ?? 1) }}_{{ $i }}" >{{ $i }}</label>
                    </div>
                @endfor

            </div>
        </td>
        <td>
            <div class="checkbox-wrap cst">
                <label for="c_author_yn_{{ ($eq ?? 1) }}" class="tmp-checkbox-group no-text"><input type="checkbox" name="c_author_yn_{{ ($eq ?? 1) }}" id="c_author_yn_{{ ($eq ?? 1) }}" value="Y" ></label>

            </div>
        </td>
        <td>
            <div class="btn-wrap mt-0 text-center">
                <a href="javascript:;" onclick="move_order(this,'up');" class="btn btn-small color-type1 btn-line font-suit">▲</a>
                <a href="javascript:;" onclick="move_order(this,'down');" class="btn btn-small color-type1 btn-line font-suit">▼</a>
                @if(($eq ?? 1) != 1)
                <a href="javascript:;" class="btn btn-small color-delete author-delete">삭제</a>
                @endif
            </div>
        </td>
    </tr>
@else
    @forelse($abs->authors as $key => $row)
        <tr class="target-author" data-sid="{{ $row->sid ?? '' }}">
            <input type="hidden" name="author_ord[]" value="{{ $key+1 ?? ($eq ?? 1) }}">
            <th class="text-center author-eq">{{ $key+1 ?? ($eq ?? 1) }}</th>
            <td>
                <div class="form-group-text">
                    <p class="text">국문 :</p>
                    <input type="text" name="name_kr[]" value="{{ $row->name_kr ?? '' }}" class="form-item" onlyKo>
                </div>
                <div class="form-group-text mt-10">
                    <p class="text">영문 :</p>
                    <input type="text" name="first_name[]" value="{{ $row->first_name ?? '' }}" class="form-item" placeholder="First Name" noneKo>
                    <input type="text" name="last_name[]" value="{{ $row->last_name ?? '' }}" class="form-item" placeholder="Last Name" noneKo>
                </div>
            </td>
            <td>
                <div class="checkbox-wrap cst">
                    @for($i = 1; $i <= $maxAddCnt; $i++)
                        <div class="checkbox-group affiliation-checkbox" style="display: {{ ($abs->affiliations->count() ?? 1) >= $i ? 'inline-block' : 'none' }}">
                            <input type="checkbox" name="affiliation_check_{{ $key+1 ?? ($eq ?? 1) }}[]" id="affiliation_check_{{ $key+1 ?? ($eq ?? 1) }}_{{ $i }}" value="{{ $i }}" {{ in_array($i, ($row->affiliation ?? [])) ? 'checked' : '' }}>
                            <label for="affiliation_check_{{ $key+1 ?? ($eq ?? 1) }}_{{ $i }}" >{{ $i }}</label>
                        </div>
                    @endfor

                </div>
            </td>
            <td>
                <div class="checkbox-wrap cst">
                    <label for="c_author_yn_{{ $key+1 ?? ($eq ?? 1) }}" class="tmp-checkbox-group no-text"><input type="checkbox" name="c_author_yn_{{ $key+1 ?? ($eq ?? 1) }}" id="c_author_yn_{{ $key+1 ?? ($eq ?? 1) }}" value="Y" {{ ($row->c_author_yn ?? 'N') == 'Y' ? 'checked' : '' }}></label>

                </div>
            </td>
            <td>
                <div class="btn-wrap mt-0 text-center">
                    <a href="javascript:;" onclick="move_order(this,'up');" class="btn btn-small color-type1 btn-line font-suit">▲</a>
                    <a href="javascript:;" onclick="move_order(this,'down');" class="btn btn-small color-type1 btn-line font-suit">▼</a>
                    @if( $key ?? ($eq ?? 1) != 1)
                        <a href="javascript:;" class="btn btn-small color-delete author-delete">삭제</a>
                    @endif
                </div>
            </td>
        </tr>
    @empty
    @endforelse
@endif