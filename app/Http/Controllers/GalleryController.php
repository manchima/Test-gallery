<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picdatas;
use function PHPSTORM_META\type;

class GalleryController extends Controller
{
    //To retrive UI
    public function index()
    {
        return view('gallerys/gallery');
    }

    //To get Image data from db
    public function getImage()
    {
        $data = Picdatas::all();
        return $data;
    }

    //To upload file to path
    public function upload(Request $request)
    {
        $data = [];
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $name = $image->getClientOriginalName();
                $despath = storage_path('app/images/');
                $size = $image->getSize();
                $mime = $image->getMimeType();
//                if($mime){ //like image
//
//                }
                $image->move($despath, $name);

                $picdata = new Picdatas();
                $picdata->user_id = auth()->user()->id;
                $picdata->image_name = 'storage/' . $name;
                $picdata->image_size = $size;
                $picdata->type = $mime;
                $picdata->save();

                $data = [
//                    'id' => $pics->id,
                    'name' => 'storage/' . $name,
                    'type' => $mime,
                    'isImage' => $mime == 'image/jpeg' || $mime == 'image/png' ? true : false,
                    'isOverMaxSize' => $size > 10485760 ? true : false,
                    'isUpload' => false,
                    'progressPercentage' => 100
                ];


            }
        }
//        echo $data;
        return response()->json([
            "message" => "success",
            "data" => $data
        ]);
    }


    public function delete(Request $request)
    {
        $picdata = new Picdatas();
        $data = Picdatas::find ( $request->id );
        $image_path = str_replace('storage', 'app/images', $data->image_name);
        if(file_exists(storage_path($image_path))){
            @unlink($image_path);
            unlink(storage_path( $image_path));

            Picdatas::find ( $request->id )->delete ();
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
