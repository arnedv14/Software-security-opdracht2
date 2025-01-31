@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="col-md-10">
                <br/><br/><br/>
                <form method="get" action="{{ route('search.result') }}" class="form-inline mr-auto">
                    <input type="text" name="query" value="{{ isset($searchterm) ? $searchterm : ''  }}" class="form-control col-sm-8"  placeholder="Search items by name..." aria-label="Search">
                    <button class="btn aqua-gradient btn-rounded btn-sm my-0 waves-effect waves-light" type="submit">Search</button>
                </form>
                <br>
                @if(isset($searchResults))
                    @if ($searchResults-> isEmpty())
                        <h2>Sorry, no results found for the term <b>"{{ $searchterm }}"</b>.</h2>
                    @else
                        <h2>There are {{ $searchResults->count() }} results for the term <b>"{{ $searchterm }}"</b></h2>
                        <hr />
                        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                            <h2>{{ ucwords($type) }}</h2>

                            @foreach($modelSearchResults as $searchResult)
                                <ul>
                                    <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                                </ul>
                            @endforeach
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
@endsection
