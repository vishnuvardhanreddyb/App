@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/posts/create" class="btn btn-primary">create post</a>
                    <h3>your blog posts</h3>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                        
                            <td>{{$post->title}}</td>
                            <td><a href="/posts/{{$post->id}}/edit" class="btn btm-primary">Edit</td>
                            <td>{!!Form::open(['action' => ['postscontroller@destroy',$post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                               {!!Form::close()!!}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <h2>you have no post</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
