<?php
use Illuminate\Support\Facades\Storage;
function InventoryImageUpload($image, $dir=null)
{


    $imageName = time() . '.' . $image->getClientOriginalExtension();
    // $extension = $image->getClientOriginalExtension();
    // $name = rand(1000,3000);
    // $imageName = $name.'.'.$extension;
    if ($dir)
    {
        $directory = $dir;
    }else
    {
        $directory = "dashboard/images/inventory/";
    }
    // $imageUrl = $directory.$imageName;
    $imageUrl = $image->move(public_path($directory),$imageName);
    return $imageUrl;
}

 function userImageUpload($image, $dir = null)
{
    // Check if a valid image file was uploaded
    if ($image->isValid()) {
        $imageName = time() . '_' . $image->getClientOriginalName();
        if ($dir) {
            $directory = $dir;
        } else {
            $directory = "/dashboard/images/dealers/";
        }

        // Move the uploaded image to the specified directory
        $image->move(public_path($directory), $imageName);
        // $image->storeAs($directory, $imageName);

        return $imageName;
    }

    // Return null if the image upload failed
    return null;
}
