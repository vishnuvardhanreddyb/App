@extends('layouts.app')
@section('content')
  <a href="/posts" class="btn btn-success">Go Back</a>
  <h1>{{$post->title}}</h1>
  <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
  <hr>
  <div>
      {{$post->body}}
  </div>
  <hr>
  <small>Written on {{$post->created_at->toFormattedDateString()}} by {{$post->user->name}}</small>
  @if(!Auth::guest())
  @if(Auth::user()->id == $post->user_id)
  <hr>
  <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
  {!!Form::open(['action' => ['postscontroller@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
   {{Form::hidden('_method','DELETE')}}
   {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
  {!!Form::close()!!}
  @endif
@endif
@endsection