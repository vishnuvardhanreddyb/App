@extends('layouts.app')

@section('content')
<h1>POSTS</h1>
@if(count($posts)>0)
     
    @foreach($posts as $post)
     <div class="well">
         <div class="row">
             <div class="col-md-4 col-sm-4">
                  <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
             </div>
             <div class="col-md-4 col-sm-4">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at->toFormattedDateString()}} by {{$post->user->name}}</small>
             </div>
        </div>
     </div>
    @endforeach
    {{$posts->links()}}
@else
     <h1>NO POSTS FOUND</h1>
@endif

@endsection