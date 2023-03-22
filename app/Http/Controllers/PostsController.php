<?php

namespace App\Http\Controllers;
use Auth; 

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'posts';
        // $posts =  Post::all();     
        // $posts =  Post::orderBy('title', 'desc')->get();     
        $posts =  Post::orderBy('title', 'desc')->paginate(2);     
        // return  Post::where('title', 'Post Two')->get();     
        return view('posts.index')->with('posts', $posts)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add New Post ';
        return view('posts.add_post')->with('title',  $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'PostTitle' => 'required',
            'Body' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);


        if($request->hasFile('post_image')){

            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'_'.$extension;

            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);

        } else{
            $fileNameToStore = `noimage.jpg`;
        }
           

        $post = new Post;
        $post->title = $request->input('PostTitle');
        $post->body = $request->input('Body');
        $post->user_id = Auth::user()->id;
        $post->post_image = $fileNameToStore;
        $post->save();

         return redirect()->back()->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id);
        $title = $post->title."  ";
        return view('posts.single_post')->with('post', $post)->with('title', $title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Post ';
        $post =  Post::find($id);

        if(auth()->user()->id != $post->user_id){
        return redirect('/posts')->with('error' , 'You cannot access that page');
        }else{
        return view('posts.edit_post')->with('title',  $title)->with('post' , $post);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'PostTitle' => 'required',
            'post_image' => 'image|nullable|max:1999'
        ]);


        if($request->hasFile('post_image')){

            $filenameWithExt = $request->file('post_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('post_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'_'.$extension;

            $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);

        }
           

        $post = Post::find($id);
        $post->title = $request->input('PostTitle');
        $post->body = $request->input('Body');
        if ($request->hasFile('post_image')) {
            $post->post_image = $fileNameToStore;
        }
        $post->save();

         return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);

       if(auth()->user()->id != $post->user_id){
        return redirect('/posts')->with('error' , 'You cannot access that page');
        }

       $post->delete();

        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
