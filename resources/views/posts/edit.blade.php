@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form method="POST" action="/posts/{{$post->id}}" enctype = "multipart/form-data">

    {{ csrf_field() }}

{{ method_field('PATCH') }}

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
    </div>

    <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" name="body" id="body" required>{{$post->body}}</textarea>
    </div>

    <div class="form-group">
            <input type="file" name="cover_image" id="image">
        </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">update</button>
    </div>
    
</form>

@endsection