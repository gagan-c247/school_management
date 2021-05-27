@extends('backend.backend',['title'=>'post show'])

@section('header')
    
@endsection
@section('content')
    <div class="row">
        <div class="offset-2 col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Role</h4>
                  <p class="card-category">Details Role</p>
                </div>
                <div class="card-body">
                    <h1 class=" text-capitalize text-center">{{$post->title ?? ''}}</h1>
                    @foreach($post->postfileuploader as $file)
                          
                    @if($file->file->type == 'jpg')
                        <div class="">
                           <a href="{{route('admin.posts.show',$post->id)}}"> <img src="{{'/storage/images/'.$file->file->filepath}}" class="img-fluid" alt=""></a>
                        </div>
                        @break
                    @endif
                    @endforeach
                    <div class="row">
                        <div class="col-md-6">
                          <a href="{{route('admin.posts.show',$post->id)}}"> <h1 class="text-capitalize">{{$post->title ?? ''}}</h1> </a>
                        </div>     
                        <div class="col-md-6 text-right">
                            <h6>{{$post->created_at->format('d M Y') ?? ''}}</h6>   
                            <h6>Author</h6>     
                        </div>   
                    </div>   
                    <section>
                        {{$post->content}}
                    </section>
                    
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($post->postfileuploader as $key => $file)
                            @if($key == '1')
                                <h6 class="mr-2">image files</h6>
                            @endif
                                @if($file->file->type == 'jpg')
                                    <div class="mr-3">
                                    <a href="{{route('admin.posts.show',$post->id)}}"> <img src="{{'/storage/images/'.$file->file->filepath}}" height="120px" weidth="120px" alt=""></a>
                                    </div>
                                @endif
                                @if($file->file->type == 'mp4')
                                    <video width="320" height="240" controls>
                                        <source src="{{url('/storage'.'/'.$file->file->filepath)}}" type="video/mp4">
                                    </video>
                                @endif
                                @if($file->file->type == 'embedded')
                                    <div class="embed-responsive embed-responsive-16by9">
                                        {!! $file->file->filepath ?? '' !!}
                                    </div>
                                
                                @endif

                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    
@endsection
