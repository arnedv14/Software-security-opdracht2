@extends('layouts.app')
@section('content')
    <h1 class="title">{{$item->name}}</h1>
    <img src="{{asset($item->image)}}"/>

    <h3><b>Number of items in stock:</b> {{$numberInStock}}</h3>
    <h3><b>Number of items available:</b> {{$numberAvailable}}</h3>
    <p>{{$item->description}}</p>
    <a href="{{route('downloadManual', $item->id)}}">Download Manual</a>
    <br/>
    <a class=" is-large button is-info" href="{{url('inventory/edit/'.$item->id)}}">Edit Item</a>
    <br/><br/>
    <form method="post" action="{{url('inventory/delete/'.$item->id)}}">
        @csrf
        <input type="hidden" name="deleteItem" value="true"/>
        <button type="submit"
                onclick="return confirm('Are you sure you want to delete this item?')"
                class="button is-danger is-large">Delete Item
        </button>
    </form>

@endsection
