@extends('layouts.app')
@section('content')

    @include('partials.error')

    <form method="post" action="{{route('postCreateItem')}}" enctype="multipart/form-data">
        @csrf
        <label for="createNameField">Name </label>
        <textarea name="name" id="createNameField" class="textarea is-large" rows="1"></textarea>
        <label for="createDescriptionField">Description: </label>
        <textarea name="description" id="createDescriptionField" class="textarea"></textarea>
        <label for="photoItem">* Photo of item (JPG- or PNG-format, max size of 3MB): </label><br/>
        <input type="file" name="photoItem" id="photoItem"/><br/><br/>
        <label for="manualItem">Manual of item (PDF-format, max size of 10MB):</label><br/>
        <input id="manualItem" name="manualItem" type="file"/><br/><br/>
        <label for="numberOfExemplaries">Number of exemplaries in stock:</label>
        <input type="number" id="numberOfExemplaries" name="numberInStock" value="0"/><br/><br/>


        <p>* Please watch out for the file resolution. Uploaded images will automatically be resized to a
            4by3-image!</p>

        <button type="submit" class="button is-info">Create</button>


    </form>
@endsection
