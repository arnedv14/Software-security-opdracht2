@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <article class="message is-success">
            <div class="message-body">
                {{session()->get('message')}}
            </div>
        </article>
    @endif
    <div class="columns is-marginless is-centered">
        <div class="column is-7">
            <nav class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Dashboard
                    </p>
                </header>

                <div class="card-content">
                    @auth
                        You are logged in, {{auth()->user()->name}}!
                    @endauth
                </div>
            </nav>
            <section class="section">
                <div class="container">


                </div>
            </section>
        </div>
    </div>
@endsection
