<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\s;

class ProductOtherImage extends Model
{
    use HasFactory;
    private static $otherImage,$imageUrl,$image,$imageName,$imageExt,$imageFullName,$imagePath;

    public static function storeOtherImages($otherImages,$id)
    {
        foreach ($otherImages as $otherImage)
        {
            self::$imageUrl = self::getImageUrl($otherImage);
            self::$otherImage = new ProductOtherImage();
            self::$otherImage->product_id = $id;
            self::$otherImage->image = self::$imageUrl;
            return self::$otherImage->save();
        }
    }

    public static function getImageUrl($otherImage)
    {
        self::$imageFullName = $otherImage->getClientOriginalName();
        self::$imagePath = 'uploads/product-other-image/';
        $otherImage->move(self::$imagePath,self::$imageFullName);
        self::$imageUrl = self::$imagePath.self::$imageFullName;
        return self::$imageUrl;
    }
}
