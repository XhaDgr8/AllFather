<?php

namespace App\Http\Controllers;

use App\Product;
use App\Profile;
use App\SubProduct;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class fileSystemController extends Controller
{

    public function folderData($user)
    {
        $files = [];
        $allFiles = File::allFiles('storage/users/'.$user.'/');
        foreach($allFiles as $path) {
            $file = pathinfo($path);
            array_push($files, $file['basename']);
        }
        return $files;
    }

    public function fileUpload(Request $request, $user)
    {
        if (count($request->images)){
            foreach ($request->images as $image){
                $image->store('/users/'.$user.'/' , 'public');
            }
        }
        return response()->json([
            "message" => 'Uploaded Successfully'
        ]);
    }

    public function deleteFile ($user, $img)
    {
        File::delete('storage/users/'.$user.'/'.$img);

        return response()->json([
            "message" => 'Deleted Successfully '
        ]);
    }

    public function avatar(Profile $user,$avatar)
    {
        $oldPath = 'storage/users/'.auth()->user()->id; // publc/images/1.jpg
        $newPath = 'storage/usedByDB/'.$user->id; // publc/images/2.jpg
        $directoryPath=public_path($newPath);

        if(File::isDirectory($directoryPath)){
            //Perform storing
            if (File::copy(public_path($oldPath."/".$avatar), $newPath."/".$avatar)) {
                $user->update(['avatar' => 'usedByDB/'.$user->id.'/'.$avatar]);
            }
        } else {
            File::makeDirectory($directoryPath, 0777, true, true);
            //Perform storing
            if (File::copy(public_path($oldPath."/".$avatar), $newPath."/".$avatar)) {
                $user->update(['avatar' => 'usedByDB/'.$user->id.'/'.$avatar]);
            }
        }
        return "updated";
    }

    public function imgProduct($user,$avatar)
    {
        $oldPath = 'storage/users/'.auth()->user()->id; // publc/images/1.jpg
        $newPath = 'storage/usedByDB/'.$user->id; // publc/images/2.jpg
        $directoryPath=public_path($newPath);

        if(File::isDirectory($directoryPath)){
            //Perform storing
            if (File::copy(public_path($oldPath."/".$avatar), $newPath."/".$avatar)) {
                $user->update(['image' => 'usedByDB/'.$user->id.'/'.$avatar]);
            }
        } else {
            File::makeDirectory($directoryPath, 0777, true, true);
            //Perform storing
            if (File::copy(public_path($oldPath."/".$avatar), $newPath."/".$avatar)) {
                $user->update(['image' => 'usedByDB/'.$user->id.'/'.$avatar]);
            }
        }
        return "updated";
    }

    public function subProductImage(SubProduct $user,$avatar)
    {
        $this->imgProduct($user, $avatar);
    }

    public function productImage(Product $user,$avatar)
    {
        $this->imgProduct($user, $avatar);
    }

}
