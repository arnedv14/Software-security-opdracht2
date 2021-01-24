@extends('layouts.app')
@section('content')
    @include('partials.error')
    <form class="form-horizontal" method="post" action="{{url('admin/edit/'.$user->id)}}">
        @csrf
        <fieldset>
            <h1>{{$message ?? ''}}</h1>

            <!-- Form Name -->
            <h1 class="title">Edit User</h1>

            <!-- Text input-->
            <div class="field">
                <label class="label" for="name">Name</label>
                <div class="control">
                    <input id="name" name="name" type="text" placeholder="{{$user->name}}" class="input " readonly>
                </div>
            </div>

            <!-- Text input-->
            <div class="field">
                <label class="label" for="email">E-mail</label>
                <div class="control">
                    <input id="email" name="email" type="text" placeholder="{{$user->email}}" readonly
                           class="input ">
                </div>
            </div>

            <!-- Select Basic -->
            <div class="field">
                <label class="label" for="Role">Role</label>
                <div class="control">
                    <div class="select">
                        <select id="Role" name="role" class="">
                            @if($user->role=='Admin')
                                <option selected>Admin</option>
                                <option>Uitleendienst</option>
                                <option>User</option>
                            @elseif($user->role=='Uitleendienst')
                                <option>Admin</option>
                                <option selected>Uitleendienst</option>
                                <option>User</option>
                            @elseif($user->role=='User')
                                <option>Admin</option>
                                <option>Uitleendienst</option>
                                <option selected>User</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to edit this user\'s permissions?')"
                            class="button is-primary">Edit
                    </button>
                    <a class="button is-info" href="{{route('admin')}}">Back</a>
                </div>
            </div>
        </fieldset>
    </form>

@endsection
