@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                    <div class="col-lg-6"><a href="/posts" class="btn btn-primary">View All Posts</a></div>
                    <div class="col-lg-6 text-end"><a href="/posts/create" class="btn btn-primary">Create Post</a></div>
                    </div>
                    <hr>
                    <h3>You Blog Posts</h3>
                    @if (count($posts) > 0)
                    <?php $i=1; ?>
                    <table class="table table-striped mt-4">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Post Title</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td><?php echo $i++ ; ?></td>
                                <td><a href="/posts/{{$post->id}}"> {{$post->title}}</a></td>
                                <td> <a class="btn btn-primary" href="/posts/{{$post->id}}/edit" >EDIT </a></td>
                                <td>                                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('DELETE', ['class' => 'btn btn-danger ']) !!}   
                                    {!! Form::close() !!}
                                </td>
                              </tr>
                        @endforeach

                        </tbody>
                      </table>

                    @else
                        <p>No Posts Created</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
