@extends('layouts.app')
@include('partials.error')
@section('content')
    <h1 class="title">{{$item->name}}</h1>
    <img src="{{asset($item->image)}}"/>

    <h3><b>Number of items in stock:</b> {{$numberInStock}}</h3>
    <p>{{$item->description}}</p>
    <a href="{{route('downloadManual', $item->id)}}">Download Manual</a>
    <br/>
    <a class=" is-large button is-info" href="{{url('loan/loanItem/'.$item->id)}}">Loan Item</a>
    <br/><br/>

@endsection
