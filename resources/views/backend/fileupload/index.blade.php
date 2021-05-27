@extends('backend.backend',['title'=>'File Upload VIDEO'])
@section('header')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="uploadVideoProgressBar" style="height: 5px; width: 1%; background: #2781e9; margin-top: -5px;"></div>
            <input type="file" id="uploadVideoFile" accept="video/*" />
        </div>
        <div class="offset-3 col-md-6" >
            <div id="videoSourceWrapper" style="display: none;">
                <video style="width: 100%; height:auto;" controls>
                    <source id="videoSource"/>
                </video>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script>
    $('#uploadVideoFile').on('change',function() {
        var fileInput = document.getElementById("uploadVideoFile");
        console.log('Trying to upload the video file: %O', fileInput);
        if ('files' in fileInput) {
            if (fileInput.files.length === 0) {
                alert("Select a file to upload");
            } else {
                var $source = $('#videoSource');
                $source[0].src = URL.createObjectURL(this.files[0]);
                $source.parent()[0].load();
                $("#videoSourceWrapper").show();
            }
        } else {
            console.log('No found "files" property');   
        }
    });
</script>
<script>
    function UploadVideo(file) {
    var loaded = 0;
    var chunkSize = 500000;
    var total = file.size;
    var reader = new FileReader();
    var slice = file.slice(0, chunkSize);
            
    // Reading a chunk to invoke the 'onload' event
    reader.readAsBinaryString(slice); 
    console.log('Started uploading file "' + file.name + '"');
        
    reader.onload = function (e) {
       //Just simulate API
       setTimeout(function(){
      loaded += chunkSize;
        var percentLoaded = Math.min((loaded / total) * 100, 100);
        console.log('Uploaded ' + Math.floor(percentLoaded) + '% of file "' + file.name + '"');
        //Read the next chunk and call 'onload' event again
        if (loaded <= total) {
          slice = file.slice(loaded, loaded + chunkSize);
          reader.readAsBinaryString(slice);
  } else { 
      loaded = total;
        console.log('File "' + file.name + '" uploaded successfully!');
        }
      }, 250);
    }
}

$('#uploadVideoProgressBar').width(percentLoaded + "%");
</script>
@endsection