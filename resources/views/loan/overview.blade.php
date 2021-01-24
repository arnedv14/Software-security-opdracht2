@extends('layouts.app')
@section('content')
    @include('partials.error')
    <table class="table">
        <thead>
        <tr>
            <th>User-id</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Item</th>
            <th>Loaned at</th>
            <th>Loaned until</th>
            <th>Remarks</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($loans as $loan)
            <tr>
                <td>{{$loan->userid}}</td>
                <td>{{$loan->username}}</td>
                <td>{{$loan->email}}</td>

                <td><a href="{{route('loanDetail', $loan->itemID)}}">{{$loan->itemName}}</a></td>
                <td>{{$loan->start_loan}}</td>
                <td>{{$loan->end_loan}}</td>
                <td>{{$loan->remarks}}</td>
                {{--                <td><a class="button is-small is-info"  href="{{url('admin/edit/'.$user->id)}}">Edit</a></td>--}}
                {{--                <td><a  class=" button is-small is-danger" onclick="return confirm('Are you sure you want to delete this user?')" href="{{url('admin/delete/'.$user->id)}}">Delete</a></td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/><br/>
    <a class="button is-info is-large" href="{{route('showLoan', 2)}}">New Loan</a>
@endsection
