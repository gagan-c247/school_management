<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collect = [1,2,3,4,5,6,7,8,9];
        // $data =  collect($collect)->chunk(3);
        // // $data->toArray();
        // $data2 =$data->collapse();
        // return $data2->all();

    //     $collection = collect(['name', 'age']);

    //     $combined = $collection->combine(['George', 29]);
    //    return    $combined->all();
//  $originalImage = 'https://static.remove.bg/remove-bg-web/207b10c4ce48e7dca1441ee119b7f52754f487fd/assets/start-0e837dcc57769db2306d8d659f53555feb500b3c5d456879b9c843d1872e7baa.jpg';
//    // 1080000  $originalImage =  'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg';
//     // $img1 = 'image.jpg';

//    $pathinfo = pathinfo($originalImage);
//     return getimagesize($originalImage);
//    $width = getimagesize($originalImage)[0]; 
//    $height = getimagesize($originalImage)[1];
//    return $width * $height;
//     $ext = $pathinfo['extension'];
//     if (preg_match('/jpg|jpeg/i',$ext))
//         $imageTmp=imagecreatefromjpeg($originalImage);
//     else if (preg_match('/png/i',$ext))
//         // return 'success';
//        $imageTmp=imagecreatefrompng($originalImage);
//     else if (preg_match('/gif/i',$ext))
//         $imageTmp=imagecreatefromgif($originalImage);
//     else if (preg_match('/bmp/i',$ext))
//         $imageTmp=imagecreatefrombmp($originalImage);
    
//     $outputImage = 'convertedImage.jpg';
    
//     imagejpeg($imageTmp, $outputImage);
//     imagedestroy($imageTmp);

  
//     // imagecreatefrompng('image.png');

//     //imagejpeg(, storage_path('public'.$fileTempNmae));
//     return 'scat';
    

      
       //Create Blank Image
       $im = imagecreatetruecolor(500, 500);
       // sets background to red
       $red = imagecolorallocate($im, 25, 25, 112);
       imagefill($im, 0, 0, $red);
       header('Content-type: image/png');
       imagejpeg($im, storage_path('app\public\userfirstImage.png'));

       $img=storage_path('app\public\userfirstImage.jpg');
       $width = getimagesize($img)['0']/3;
       $height = getimagesize($img)['1']/;
       $imge = imagecreatefromjpeg($img);
       $white = imagecolorallocate($imge, 0, 0, 0);
       $black = imagecolorallocate($imge, 250,235,215);
      imagefilledrectangle($imge, 0,  getimagesize($img)['1']-60, getimagesize($img)['0'], getimagesize($img)['1'], $black); // to give border to text
      //l 
      // t
      // r
      //b
    //    imagefilledrectangle($imge, 80, 350, 340,450, $black); //filled full bg in text
       $txt = "gagan";
       $font = public_path("/js/Achafexp.ttf");
    // $bbox = imagettfbbox(10, 45, $font, $txt);
        // This is our cordinates for X and Y
    //  $x = $bbox[0] + (imagesx($imge) / 2) - ($bbox[4] / 2) - 25;
    //     $y = $bbox[1] + (imagesy($imge) / 2) - ($bbox[5] / 2) - 5;

    //    imagettftext($imge, 50, 0, 103, 403, $black, $font, $txt);
    $font = public_path("/js/arial.ttf");
       $imag = imagettftext($imge, 50, 0, $width,   $height, $white, $font, 'hello');
        
       imagejpeg($imge);
       dd($imge);
       imagedestroy($imge);
    }

    function convertImage($originalImage, $outputImage, $quality)
    {
        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1]; 

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        else
            return 0;

        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
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
        //
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
        //
    }
}
