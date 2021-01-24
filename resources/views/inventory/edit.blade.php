@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('postEditItem',$item->id)}}" enctype="multipart/form-data">
        @csrf
        <label for="createNameField">Name </label>
        <textarea name="name" id="createNameField" class="textarea is-large" rows="1">{{$item->name}}</textarea>
        <label for="createDescriptionField">Description: </label>
        <textarea name="description" id="createDescriptionField" class="textarea" >{{$item->description}}</textarea>
        <label for="photoItem">* Upload a new photo of the item (JPG- or PNG-format, max size of 3MB): </label><br/>
        <input type="file" name="photoItem" id="photoItem"/><br/><br/>
        <label for="manualItem">Upload a new manual of the item (PDF-format, max size of 10MB):</label><br/>
        <input id="manualItem" name="manualItem" type="file" /><br/><br/>
        <label for="numberOfExemplaries">Number of exemplaries in stock:</label>
        <input type="number" id="numberOfExemplaries" name="numberInStock" value="{{$numberInStock}}"/><br/><br/>


        <p>* Please watch out for the file resolution. Uploaded images will automatically be resized to a
            4by3-image!</p>

        <button type="submit" class="button is-info">Edit</button>


    </form>
@endsection
