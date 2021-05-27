@extends('backend.backend',['title'=>'File Upload'])
@section('header')
<!-- Croper CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.css">
<style>
  #galleryImages, #cropper{
  /* width: 50%; */
  float: left;
  display: inline-block;
  }
  canvas{
      height: 119px;
      display: inline-block;
      border: solid 5px #d0d0d0;
      width: 119px;
  }
  #cropperImg{
  /*max-width: 0;
  max-height: 0;*/
  }
  #cropImageBtn{
  display: none;
  }
  img{
  width: 100%;
  }
  .img-preview{
  float: left;
  }
  .singleImageCanvasContainer{
  max-width: 300px;
  display: inline-block;
  position: relative;
  margin: 2px;
  }
  .singleImageCanvasCloseBtn{
      position: absolute;
      top: -1px;
      right: 3px;
      border-radius: 21px !important;
      margin: 0px;
  }
</style>
@endsection
@section('content')
<form action="{{route('admin.fileupload.store')}}" method="post" enctype="multipart/form-data">
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <div class="card card-plain"> 
        <!--Heading-->
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">File <Form></Form>
          <p class="card-category"> View All file Details</p>
        </div>
        <!--Heading-->
        <!--Body-->
        <div class="card-body">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <!-- Modal -->
              <label for="" class="d-block">select your images or video</label>
              <a data-toggle="modal" href="#myModal" class="btn btn-primary">Choose File</a>
              <label for=""><span class="text-danger" id="totalimages"></span> <span id="video"></span><span class="text-danger" id="videoupdate"></span></label>

              <input type="file" id="imageCropFileInput" name="images[]" class="form-control d-none" multiple="" accept=".jpg,.jpeg,.png">

              {{-- Image view section --}}
              {{-- <input type="hidden" id="profile_img_data">
              <div class="img-preview"></div>
              <div class="row">
                <div class="col-md-12">
                    <div id="galleryImages"></div>
                </div>
              </div> --}}
              {{-- Image view section --}}
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="submit" class="form-control btn btn-success">
              </div>
            </div>
          </div>
          
          <div class="row">
              <div class="col-md-12">
                  {{-- <div id="uploadVideoProgressBar" style="height: 5px; width: 1%; background: #2781e9; margin-top: -5px;"></div> --}}
                  <input type="file" id="uploadVideoFile" class="d-none" name="localvideo" accept="video/*" />
              </div>
              {{-- <div class="col-md-12 p-2" >
                  <div id="videoSourceWrapper" style="display: none;">
                      <video style="width: 100%; height:auto;" controls>
                          <source id="videoSource"/>
                      </video>
                  </div>
              </div> --}}
          </div>
        </div>
        <!--Body-->
      </div>
    </div>
    <div class="col-md-8"></div>
  </div>
</div>
<!--FIRST MODAL-->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Upload file</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="container"></div>
      <div class="modal-body">  
        <div class="form-group">
            <input type="radio" name="upload"  value="upload" class="uploadImage"> <span >upload image</span> 
            <input type="radio" name="upload" value="url" class="uploadImage"> <span >url</span> 
        </div>
        {{-- Upload Image section --}}
        <div class="form-group upload-file" style="display:none">  
          <label class="d-block">Upload Images Or Video</label> 
          <!--Image seclect-->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <button type="button" class="choosefile btn btn-warning">Choose Images</button>
              </div>
            
              {{-- Image view section --}}
              <input type="hidden" id="profile_img_data">
              <div class="img-preview"></div>
              <div class="row">
                <div class="col-md-12">
                    <div id="galleryImages"></div>
                </div>
              </div>
             {{-- Image view section --}}

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <button type="button" class="choosevideo btn btn-warning">Choose Video</button>
              </div>
              <div class="row">
                <div class="col-md-12 p-2" >
                  <div id="videoSourceWrapper" style="display: none;">
                      <video style="width: 100%; height:auto;" controls>
                          <source id="videoSource"/>
                      </video>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
         
         
          <a data-toggle="modal" href="#myModal2" id="crop-modal" class="btn btn-primary d-none">Launch modal</a>
        </div>
        {{-- Upload Image section --}}
        {{-- Upload URL Section Embeded Code --}}
        <div class="upload-url" style="display:none">
          <div class="row">
            <div class="col-md-12">
              <label for="">image url</label>
              <input type="text" name="url" class="form-control border-bottom text-dark" placeholeder="Paste Your Embeded Url" id="file-url">
            </div>
            <div class="col-md-12">
              <div class="embeded embed-responsive embed-responsive-16by9"></div>
            </div>
          </div>
        </div>
        {{-- Upload URL Section Embeded Code --}}
      </div>
      <div class="modal-footer">
        <a href="#" data-dismiss="modal" class="btn">Close</a>
        {{-- <a href="#" class="btn btn-primary">Save changes</a> --}}
      </div>
    </div>
  </div>
</div>
<!--FIRST MODAL-->
<!--SECOUND MODAL-->
<div class="modal" id="myModal2" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crop Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="container"></div>
      <div class="modal-body">
          <div id="cropper">
            <canvas id="cropperImg" width="300px" height="300px"></canvas>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modalClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="cropImageBtn btn btn-primary" id="cropImageBtn">Crop</button>
          {{-- <a href="#" data-dismiss="modal" class="btn">Close</a>
          <a href="#" class="btn btn-primary">Save changes</a> --}}
      </div>
    </div>
  </div>
</div>
<!--SECOUND MODAL-->
</form>
@endsection
@section('footer')
<!-- Footer Part -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.js"></script>
<script src="{{asset('/backend/js/fileupload.js')}}"></script>
<script>
  $(document).on('click','.choosefile',function(){
      $('#imageCropFileInput').trigger('click');
  });
</script>
<script>
  $(document).on('click','.uploadImage',function(){
        $uploadType =  $('input[name="upload"]:checked').val();
       
        if($uploadType == 'url'){
            $('.upload-url').show();
            $('input[name="images[]"]').val(''); 
            $('#totalimages').text(' ');
            $('#galleryImages').html(' ');
        }else{
            $('.upload-url').hide();
        }
        if($uploadType == 'upload'){
            $('.upload-file').show();
            $('input[name="url"]').val('');
            $('#file-url').trigger('change');
        }else{
            $('.upload-file').hide();
        }
    });

  $('#file-url').change(function(){
      var video = $('#file-url').val();
     
      $('.embeded').html(video);
      if(video != ''){
        $('#video').text('You have select url');
      }else{
        $('#video').text(' ');
      }
    });
</script>

<script>
  $(document).on('click','.choosevideo',function(){
    $('#uploadVideoFile').click();
  });
</script>
@endsection