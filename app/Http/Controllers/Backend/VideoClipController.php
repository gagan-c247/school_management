<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;        
use Illuminate\Http\Request;
use Image;
// use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Filters\Video\ClipFilter;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Filesystem\Media;
use ProtoneMedia\LaravelFFMpeg\MediaOpener; 
// use ProtoneMedia\LaravelFFMpeg\Support\TimeCode;
use ProtoneMedia\LaravelFFMpeg\Exporters\MediaExporter;
use Storage;
use FFMpeg\Filters\Video\VideoFilters;
class VideoClipController extends Controller
{
    public function index(){
        return view('backend.videoclip.index');
    }
    public function makeimage()  
    {
        //create dir in storage temp dir 
        Storage::makeDirectory('public\user');
        //Create Blank Image
        $im = imagecreatetruecolor(800, 800);
        // sets background to red
        $red = imagecolorallocate($im, 25, 25, 112);
        imagefill($im, 0, 0, $red);
        header('Content-type: image/png');
        imagejpeg($im, storage_path('app\public\user\userfirstImage.jpg'));
        // dd($im);
        imagedestroy($im);

        $img1 = public_path('storage\user\userfirstImage.jpg');
        $img2 = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/1200px-Image_created_with_a_mobile_phone.png';
        $img3 = 'https://static.remove.bg/remove-bg-web/207b10c4ce48e7dca1441ee119b7f52754f487fd/assets/start-0e837dcc57769db2306d8d659f53555feb500b3c5d456879b9c843d1872e7baa.jpg';
        $img4 = 'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg';
        $title = ['this is first title', 'this is secound title', 'this is third title', 'this is fourth title'];
        $filecount = 1;
        foreach([$img1,$img2,$img3,$img4] as $key => $image){
            $image = $this->imageCovert($image,$key);
            // for($i = 0; $i < 4; $i++){
                $img = imagecreatefromjpeg($image);
                //text center align 
                $width = getimagesize($image)['0']/4;
                $height = getimagesize($image)['1']/2;

                $white = imagecolorallocate($img, 255,255,255);
                // $black = imagecolorallocate($img, 0, 0, 0);
                if( $key > 0){
                $black = imagecolorallocate($img, 255,69,0);
                //imagefilledrectangle($img   , 0,  getimagesize($image)['1']/4, getimagesize($image)['0'], getimagesize($image)['1']/2, $black); // to give border to text
                imagefilledrectangle($img, 0,  getimagesize($image)['1']-100, getimagesize($image)['0'], getimagesize($image)['1'], $black);
                }
                // imagerectangle($img, 80, 350, 340,450, $black);
                $txt = $title[$key];
                $font = public_path("/js/arial.ttf");
                $imageWidthSize = getimagesize($image)['0']; //width * height (Actual size)
                if( $imageWidthSize <=250){
                    $fontsize = 30;
                }else if( $imageWidthSize <=600){
                    $imageWidthSize = 30;
                }else if($imageWidthSize <= 1000){
                    $fontsize = 60; 
                }else if($imageWidthSize > 1000){
                    $fontsize = 70; 
                }
                // $imag = imagettftext($img, $fontsize, 0, getimagesize($image)['0']/3, getimagesize($image)['1']-10, $white, $font, $txt);
                if($key > 0){
                    $imag = imagettftext($img, $fontsize,0, 50, getimagesize($image)['1']-22, $white, $font, $txt);
                }else{
                    $imag = imagettftext($img, $fontsize, 0, getimagesize($image)['0']/5, (getimagesize($image)['1']/2), $white, $font, $txt);
                }
             
                // (C) OUTPUT IMAGE
            
                header('Content-type: image/jpeg');
                
                $fileStore = '\username_'.str_pad('0'.$filecount,12,"0",STR_PAD_LEFT).'.jpg';
                imagejpeg($img, storage_path('app\public\user'.$fileStore));
                
                // dd($img);
                
                imagedestroy($img);
                $filecount++;
            // }            
        }
        // return 's';
        return redirect()->route('admin.makeVideo');
    }  

    public function imageCovert($originalImage,$i)
    {
        $pathinfo = pathinfo($originalImage);
        $ext = $pathinfo['extension'];

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            // return 'success';
           $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        
        $outputImage = 'app\public\user\convertedImage'.$i.'.jpg';
        
        imagejpeg($imageTmp, storage_path($outputImage),100);
        imagedestroy($imageTmp);
        return storage_path($outputImage);
    }
   public function makeVideo()
    {
 
    
        // FFMpeg::
        (new MediaOpener)->
        open('public\user\username_%12d.jpg')
        ->export()
        ->asTimelapseWithFramerate(1)
        ->inFormat((new \FFMpeg\Format\Video\X264)
                    // ->setKiloBitrate(250)
                    ->setAdditionalParameters([
                        '-vf', 'format=yuv420p', // Extends compatibility with most players
                        '-tune', 'stillimage', // Tune for still images
                    ]))
        ->addFilter(function (VideoFilters $filters) {
            $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
        })
        ->save('public/video.mp4');
        $dir = 'user';
        Storage::deleteDirectory('public/'.$dir);
        $video =  'video.mp4';
        FFMpeg::cleanupTemporaryFiles();


        try{

            FFMpeg::fromDisk('local')
            ->open(['public\video.mp4','audio.mp3'])
            ->export()
            ->addFormatOutputMapping(new \FFMpeg\Format\Video\X264, Media::make('local','new_video.mp4'), ['0:v', '1:a'])
            ->save();    
        }catch(\Exception $e){
            return $e->getmessage();
        }

        // FFMpeg::fromDisk('local')
        // ->open(['new_video.mp4','demo.mp4'])
        // ->export()
        // ->addFilter('[0:v][1:v]', 'hstack', '[v]')  // $in, $parameters, $out
        // ->addFormatOutputMapping(new \FFMpeg\Format\Video\X264, Media::make('local', 'stacked_video.mp4'), ['0:v','0:a','1:v','1:a','[v]'])
        // ->save();

        

            return 'sce'; 
        
        return view('backend.videoclip.index',compact('video'));
    }
    

    public function show($id)
    {
        return 'success';
        # code...
    }

    /*
    add two concinate

    FFMpeg::fromDisk('local')
        ->open(['new_video.mp4','demo.mp4'])
        ->export()
        ->concatWithoutTranscoding()
        ->save('concat.mp4');
    */ 

    public function joinTwoVideo()
    {
        FFMpeg::fromDisk('local')
        ->open(['2s.mp4','public\video.mp4','2s.mp4'])
        ->export()
        ->concatWithoutTranscoding()
        ->save('concat4.mp4');
    }
}



