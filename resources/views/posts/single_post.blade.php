@extends('layouts.app')

@section('content')
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                          <div class=" mb-3">
                            <img class="card-header card-img-top" src="/storage/post_images/{{$post->post_image}}" width="100%" alt="Card image cap">
                            <small class=" text-muted">
                              Posted At :  {{$post->created_at->format('d-m-20y')}}                              </small>                             
                          </div>  

                          <div class="card mb-3">
                            <div class="card-body text-center">
                              <h3 class="card-title">{{$post->title}}</h3>
                              <p class="card-text">{!!$post->body!!}</p>
                            </div>
                          </div>  

                          @if (!auth::guest())
                          @if(auth::user()->id == $post->user_id)
                          <div class="card mb-3">
                            <div class="row card-body text-center">
                              <div class="col-lg-6">
                                <a class="btn btn-primary" href="/posts/{{$post->id}}/edit" >EDIT post</a>
                              </div>
                              <div class="col-lg-6">
                                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::submit('DELETE post', ['class' => 'btn btn-danger ']) !!}   
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>              
                          @endif                                        
                          @endif                                        

                    </div>
                </div>
            </div>
@endsection