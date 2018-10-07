<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picdatas;

class ImagesController extends Controller
{
    //
    public function getImage()
    {
        $data = Picdatas::all();
        return $data;
    }

    public function upload(Request $request)
    {
        dd($request->path());
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $image->store('images');

//                $data = new Picdatas();
//                $data->image_name = $image->filename;
//                $data->image_size = 0;
//                $data->save();
            }
        }


        return response()->json([
        "message" => "$request"
        ]);
    }
    public function delete(Request $request)
    {
//        $image_path = "storage/app/images/55.jpeg";  // Value is not URL but directory file path
//        if(File::exists($image_path)) {
//            File::delete($image_path);
//        }

        if(file_exists('images/55.jpeg')){
            @unlink('images/55.jpeg');
            unlink(public_path() .  '/images/' . '55.jpeg' );
        }
    }

    public function store(Request $request)
    {
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/').$name);
        }

        $image= new FileUpload();
        $image->image_name = $name;
        $image->save();

        return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }
}
