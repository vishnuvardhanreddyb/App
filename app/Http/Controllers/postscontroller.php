<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\http\Requests\postRequest;

use App\http\Controllers\Controller;

use App\post;

use DB;

class postscontroller extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for normal calling of posts $posts = post::all();
        // without useing eloquent $posts = DB::select('SELECT * FROM posts');
        // used to disply only one $posts = post::orderby('title','desc')->take(1)->get();
        //used to get ordered $posts = post::orderby('title','desc')->get();
        $posts = post::orderby('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

             'title' => 'required',
             'body' => 'required',
             'cover_image' => 'image|nullable|max:1999'

        ]);

        //handle file upload
        if($request->hasfile('cover_image')){
         
            // get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name
            $fileName = $request->path($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //filename to srote
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //upload 
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

                     

        }else{
            $fileNameToStore = 'noimage.jpg'; 
        }
        
        //create post
        $post = new post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = post::find($id);
        if(auth()->user()->id !==$post->user_id){
        return redirect('/posts')->with('error', 'unautharized page');  
        }
        return view('posts.edit')->with('post',$post);
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
        $this->validate($request, [

            'title' => 'required',
            'body' => 'required'

       ]);

       //handle file upload
       if($request->hasfile('cover_image')){
         
        // get filename with extension
        $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
        //get just file name
        $fileName = $request->path($fileNameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        //filename to srote
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        //upload 
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

    }
       
       //update post
       $post = post::find($id);
       $post->title = $request->input('title');
       $post->body = $request->input('body');
       if($request->hasfile('cover_image')){
           $post->cover_image = $fileNameToStore;
       }
       $post->save();
       return redirect('/posts')->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
            if(auth()->user()->id !==$post->user_id)
        {
            return redirect('/posts')->with('error', 'unautharized page');  
        }

            if($post->cover_image != 'noimage.jpg'){
                //delete image
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
         $post->delete();
         return redirect('/posts')->with('success','deleted successfully');      
    }

    
}
