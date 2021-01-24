@extends('layouts.app')
@section('content')
    @include('partials.error')
    <nav class="panel">
        <p class="panel-heading">
            Inventory management
        </p>
        <div class="panel-block">
            <form method="post" action="{{route('search.result')}}" class="searchfield">
                @csrf
                <input class="input" type="text" name="query" placeholder="Search"/>
                <button type="submit" class="is-info">Search</button>
            </form>
            <span class="icon is-left">
            <i class="fas fa-search" aria-hidden="true"></i>
          </span>
            </p>
        </div>
        <div class="panel-block">
            <div class='columns is-mobile'>
                <div class='column'>
                    <div class='list'>
                        <ul>
                            @foreach($items as $item)
                                <div class='list-item'>
                                    <li>
                                        {{$item->name}}
                                        <a href="{{url('inventory/'.$item->id)}}" class="detail-button button is-info">Details</a>
                                    </li>

                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <a class="button is-success is-large" href="{{route('createItem')}}">
        New Item
    </a>
    <br/><br/>
@endsection
