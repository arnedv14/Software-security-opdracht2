@extends('layouts.app')
@section('content')
    @include('partials.error')
    <a class="button is-info" href="{{route('loanOverview')}}">Loans overview</a>
    @foreach($items as $item)
        @if($loop->iteration == 1 || $loop->index % 3 == 0 )
            <div class="columns">
                @endif
                <div onclick="location.href='{{url('inventory/'.$item->id)}}'" style="cursor: pointer;"
                     class="column is-one-third">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="{{asset($item->image)}}"/>
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title">{{$item->name}}</p>
                                </div>
                            </div>

                            <div class="content">
                                <p>{{Str::limit($item->description, 145)}}</p>
                                <p>Number of items available: <b>{{$numberInStock[$loop->index]}}</b></p>
                                <a href="{{url('loan/'.$item->id)}}">Show Details</a>
                                <a class=" button is-info" href="{{url('loan/loanItem/'.$item->id)}}">Loan Item</a>
                            </div>
                        </div>
                    </div>


                </div>

                @if($loop->iteration %3 ==0 || $loop->last)
            </div>
        @endif
    @endforeach
    <a class="button is-success is-large" href="{{route('showLoan',1)}}">
        New Loan
    </a>
    <br/><br/>





@endsection
