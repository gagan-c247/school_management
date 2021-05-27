<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FileUpload;
use Storage;
use App\File;
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.fileupload.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files = FileUpload::where('user_id',auth()->id())->with('file')->get();
        return view('backend.fileupload.create',compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $data['user_id'] = auth()->id();
        $files = '';
        $upload = '';
            if($request->localvideo != ''){
                $data['type'] = $request->localvideo->extension();
                $data['name'] = $request->localvideo->getClientOriginalName();
                $data['filepath'] = $request->localvideo->storeAS('video', $data['name'], 'public');
                $upload = File::create($data);
                FileUpload::create(['file_id'=>$upload->id,'user_id'=>$data['user_id']]);
                //session()->flash('success','Successfully upload');
            }
        // return $request->all();
    //    if($request->url !=''){
    //     $files = $this->urlUpload($request->url);
        
    //     $data['type'] = substr($files,strrpos($files,'.')+1);
    //     $data['filepath'] = $files;
    //     $upload = File::create($data);
    //    } 
       if($request->images != ''){
            if($request->hasFile('images')){
                foreach( $request->images as $profile){
                    $data['type'] = $profile->extension();
                    $data['filepath'] = $profile->getClientOriginalName();
                    $file = $profile->storeAS('images',$data['filepath'],'public');
                    $upload = File::create($data);
                    $fileuploader = FileUpload::create(['file_id'=>$upload->id,'user_id'=>  $data['user_id']]);
                }
            }else{
                session()->flash('danger','Choose image blog');
                return redirect()->back()->withInput();
            }
        }
        // if($upload != ''){
        //     FileUpload::create(['file_id'=>$upload->id,'user_id'=>  $data['user_id']]);
        //     session()->flash('success','SuccessFully Uploaded Files');
        // }else{
        //     session()->flash('danger','Error Not Uploaded Files');
        // }
        
        return redirect()->back();  
    }

    public function urlUpload(String $url){
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put('/public/images/'.$name, $contents);
        return $name;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    public function delete($id){
        // return $id;
        $file = FileUpload::find($id);
        $file->delete();
        // session()->flash('warning','Successfully Delete');
        return response()->json(['status'=>'success','message'=>'Successfully Deleted']);
    }
}
