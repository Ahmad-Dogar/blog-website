@extends('layouts.app')

@section('content')

{!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="container my-4 bg-light p-4">
      <div class="row">
        <div class="col-12">
          <div class="form-group mb-4">
            {{Form::label('PostTitle', 'Post Title')}}
            {{Form::text('PostTitle', $post->title, ['class' => 'form-control', 'placeholder' => 'Title Name here...'])}}
          </div>
          <div class="form-group mb-4">
            {{Form::label('Body', 'Body')}}
            {{Form::textarea('Body', $post->body, ['id'=> 'article-ckeditor',  'class' => 'form-control', 'placeholder' => 'Add Post Content Here...'])}}
          </div> 
          <div class="form-group mb-4">
            {{Form::file('post_image')}}
          </div> 
          {!! Form::hidden('_method', 'PUT') !!}
          {!! Form::submit('Submit', ['class' => 'btn btn-primary w-100']) !!}         
        </div>
      </div>
    </div>
{!! Form::close() !!}

@endsection