<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function uploadImages($file,$type="public",$sizes= ["300" , "600" , "900"])
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/upload/images/{$year}/{$month}/{$type}/";
        $filename = $file->getClientOriginalName();
        $filename=explode('.',$filename);
        $filename=end($filename);
        $filename = uniqid().'.'.$filename;
        $file = $file->move(public_path($imagePath) , $filename);

        $url['images'] = $this->resize($file->getRealPath() , $sizes , $imagePath , $filename);
        $url['thumb'] = $url['images'][$sizes[0]];

        return $url;
    }

    private function resize($path , $sizes , $imagePath , $filename)
    {
        $images['original'] = $imagePath . $filename;
        foreach ($sizes as $size) {
            $sizeName=$size;
            $size=explode('-',$size);
            if(!isset($size[1]))
            {
                $size[1]=$size[0];
            }
            $images[$sizeName] = $imagePath . "{$sizeName}_" . $filename;

            Image::make($path)->fit($size[0], $size[1], function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($images[$sizeName]));
        }

        return $images;
    }



}
