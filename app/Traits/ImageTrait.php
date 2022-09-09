<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\File;

trait ImageTrait
{
    /**
     * @param $image
     * @return string
     * @throws Exception
     */
    public static function saveImage($image): string
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new Exception('invalid message type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);
            if ($image === false) {
                throw new Exception('Failed');
            }
        } else {
            throw new Exception('did not match data URI');
        }

        $dir = 'images/';
        $file = time().'.'.$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir.$file;

        if (!File::exists($absolutePath)){
            mkdir($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
