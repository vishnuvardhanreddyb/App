@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form method="POST" action="posts/{{$post->id}}">

    {{ csrf_field() }}
{{ method_field('DELETE') }}
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
    </div>

    <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" name="body" id="body" required>{{$post->body}}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Delete</button>
    </div>
    
</form>

@endsection