@extends('layouts.app')
@section('content')
    @include('partials.error')
    <form class="form-horizontal" method="post" action="{{url('admin/create')}}">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <h1 class="title">Create new user</h1>

            <!-- Text input-->
            <div class="field">
                <label class="label" for="name">Name</label>
                <div class="control">
                    <input id="name" name="name" type="text" placeholder="Name" class="input">
                </div>
            </div>

            <!-- Text input-->
            <div class="field">
                <label class="label" for="email">E-mail</label>
                <div class="control">
                    <input id="email" name="email" type="text" placeholder="E-mail"
                           class="input ">
                </div>
            </div>

            <!-- Select Basic -->
            <div class="field">
                <label class="label" for="Role">Role</label>
                <div class="control">
                    <div class="select">
                        <select id="Role" name="role" class="">
                            <option value="Admin">Admin</option>
                            <option value="Uitleendienst">Uitleendienst</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="label" for="Type">Type</label>
                <div class="control">
                    <div class="select">
                        <select id="Type" name="type" class="">
                            <option value="Medewerker EhB">Medewerker EhB</option>
                            <option value="Docent">Docent</option>
                            <option value="Student">Student</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="field"></div>
                <label class="label" for="Password">Password</label>
                <div class="control">
                    <input id="Password" name="password" type="password" class="input"/>
                </div>
            <br/>
            <div class="field">
                <div class="control">
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to create this user?')"
                            class="button is-primary">Create
                    </button>
                    <a class="button is-info" href="{{route('admin')}}">Back</a>
                </div>
            </div>
        </fieldset>
    </form>

@endsection
