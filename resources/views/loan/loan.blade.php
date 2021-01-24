@extends('layouts.app')
@include('partials.error')
@section('content')
    <form method="post" action="{{route('performLoan')}}">
        @csrf
        <div class="field">
            <label class="label">Item</label>
            <div class="control">
                <select name="item">
                    @if(isset($item))
                        @foreach($items as $itemL)
                            @if($item->id==$itemL->id)
                                <option selected value="{{$itemL->name}}">{{$itemL->name}}</option>
                            @else
                                <option value="{{$itemL->name}}">{{$itemL->name}}</option>
                            @endif
                        @endforeach
                    @else
                        @foreach($items as $itemL)
                            <option value="{{$itemL->name}}">{{$itemL->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="field">
            <label class="label">Begindate</label>
            <div class="control">
                <input name="beginDate" type="date"/>
            </div>
        </div>
        <div class="field">
            <label class="label">Enddate</label>
            <div class="control">
                <input name="endDate" type="date"/>
            </div>
        </div>
        <div class="field">
            <label class="label">Remarks</label>
            <div class="control">
                <textarea name="remarks"></textarea>
            </div>
        </div>
        <div class="field">
            <label class="label">E-mail loaner</label>
            <div class="control">
                <input type="text" name="email" class="input"/>
            </div>
        </div>
        <div class="field">
            <button class="is-large" type="submit">Submit</button>
        </div>
    </form>
@endsection
