@if($errors->any())
    <div class="alert alert-danger">
        <article class="message is-danger">
            <div class="message-body">
                {{$errors->first()}}
            </div>
        </article>
    </div>
@elseif(session()->has('message'))
    <div class="alert alert-succes">
        <article class="message is-success">
            <div class="message-body">
                {{session()->get('message')}}
            </div>
        </article>
    </div>
@endif
