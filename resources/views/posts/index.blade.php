@extends('layouts.app')

@section('content')

    @if (count($posts)  > 0)
  
    <div class="container mt-4">
      <div class="row">
            @foreach ($posts as $post)
                    <div class="col-lg-6" >
                          <div class="card mb-3">
                            <img class="card-header card-img-top p-0" src="/storage/post_images/{{$post->post_image}}" width="100%" alt="Card image cap">
                            <div class="card-body">
                              <h4 class="card-title">{{$post->title}}</h4>
                              {{-- <p class="card-text text-truncate">{!!$post->body!!}</p> --}}
                              <a href="/posts/{{$post->id}}" class=" btn-primary">Read More>></a>                          
                            </div>
                            <div class="card-footer text-muted">
                              Posted At :  {{$post->created_at->format('d-m-20y')}}
                            </div>                            
                          </div>  
                    </div>
    @endforeach
  </div>
</div>    
    <div class="container mt-4">
      <div class="row justify-content-center">
          <div class="col-lg-2 text-center">    
             {{$posts->links('pagination::bootstrap-4')}}
          </div>
      </div>
    </div>
    @else
        <p>No Posts </p>
    @endif
@endsection