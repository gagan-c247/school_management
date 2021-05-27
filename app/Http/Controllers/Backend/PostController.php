<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\File;
use App\PostFileUploader;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('id','desc')->with('postfileuploader')->get();
        return view('backend.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request['user_id']=auth()->id();
        $post = Post::create(['title'=> $request->title,'content'=>$request->content,'user_id'=>$request->user_id]);
        
        if($request->localvideo != ''){
            $data['type'] = $request->localvideo->extension();
            $data['name'] = $request->localvideo->getClientOriginalName();
            $data['filepath'] = $request->localvideo->storeAS('video', $data['name'], 'public');
            $file = File::create($data);
            PostFileUploader::create(['file_id'=>$file->id,'user_id'=>$request['user_id'],'post_id'=>$post->id]);
        }

        if($request->images != ''){
            if($request->hasFile('images')){
                foreach( $request->images as $profile){
                    $data['type'] = $profile->extension();
                    $data['filepath'] = $profile->getClientOriginalName();
                    $file = $profile->storeAS('images',$data['filepath'],'public');
                    $file= File::create($data);
                    $fileuploader = PostFileUploader::create(['file_id'=>$file->id,'user_id'=>  $request['user_id'],'post_id'=>$post->id]);
                }
            }else{
                session()->flash('danger','Choose image blog');
                return redirect()->back()->withInput();
            }
        }
        if($request->url != ''){
            $data['type'] = 'embedded';
            $data['name'] = 'embeddedUrl';
            $data['filepath'] = $request->url;
            $file = File::create($data);
            PostFileUploader::create(['file_id'=>$file->id,'user_id'=>$request['user_id'],'post_id'=>$post->id]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('postfileuploader')->find($id);
        return view('backend.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
