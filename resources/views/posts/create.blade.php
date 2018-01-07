@extends('layouts.app')

@section('content')
<h1>Create Posts</h1>
{!! Form::open(['action' => 'postscontroller@store', 'method' =>'POST', 'enctype' => 'multipart/form-data' ]) !!}
   
    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" id="title" required>
    </div>

    <div class="form-group">
        <label for="body">Body:</label>
        <textarea class="form-control" name="body" id="body" required></textarea>
    </div>

    <div class="form-group">
        <input type="file" name="cover_image" id="image">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">publish</button>
    </div>
    
    {!! Form::close() !!}
@endsection