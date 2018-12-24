<?php

namespace App\Http\Repository;

use App\Image;

class ImageRepository
{
    public function get()
    {
        
    }

    public function add(int $item_id)
    {
        $image = new Image();
        $image->item_id = $item_id;
        $image->url1 = "400043501.jpg";

        $image->save();
    }
    
}
