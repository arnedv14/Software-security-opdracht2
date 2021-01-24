@extends('layouts.app')
@section('content')
    @include('partials.error')
    <table class="table">
        <thead>
        <tr>
            <th>User-id</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Type</th>
            <th>Items loaned</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->type}}</td>
                <td>N.A.</td>
                <td><a class="button is-small is-info"  href="{{url('admin/edit/'.$user->id)}}">Edit</a></td>
                <td><a  class=" button is-small is-danger" onclick="return confirm('Are you sure you want to delete this user?')" href="{{url('admin/delete/'.$user->id)}}">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/><br/>
    <a class="button is-info is-large" href="{{route('createUser')}}">Create new user</a>
@endsection
