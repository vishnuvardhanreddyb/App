@extends('layouts.app')
@section('content')
 <section class="jumbotron text-center">
        <div class="container">
          <h1 class="display-3">{{$title}}</h1>
          <p>This is the index page for your App</p>
          <p>
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login &raquo;</a>
            <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register &raquo;</a>
          </p>
        </div>
    </section>
 @endsection