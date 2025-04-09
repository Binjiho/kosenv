@extends('admin.layouts.popup-layout')

@section('addStyle')
    <style>
    </style>
@endsection

@section('contents')
    <form id="regFrm" method="post" action="{{ route('registration.data',['work_code'=>$work_code]) }}" onsubmit="" data-sid="{{ !empty($reg->sid) ? $reg->sid : '' }}" data-case="registration-complete">
        <input type="hidden" name="work_code" value="{{ $work_code ?? '' }}" readonly>
        <input type="hidden" name="price" id="price" value="{{ $reg->price ?? 0 }}" readonly>

        <fieldset>
            @include('workshop.'.$work_code.'.'.'registration.form.preview-frm')

        </fieldset>

    </form>
@endsection
