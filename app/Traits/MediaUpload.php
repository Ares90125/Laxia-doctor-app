<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use FFMpeg;

trait MediaUpload
{
    public function mediaUpload($query, $upload_path) 
    {
        $path = Storage::disk('s3')->put($upload_path, $query);

        return [
            'path' => "storage/" . $path,
            'file' => $query->getClientOriginalName() //$image_full_name
        ];
    }

    public function mediaUploadWithThumb($uploadPath, $file, $size = 500)
    {
        $filename = generateRandomString(6, 4);
        $filepath = $uploadPath . "/{$filename}." . $file->getClientOriginalExtension();
        Storage::disk('s3')->put($filepath, file_get_contents($file));

        $mime = $file->getMimeType();
        $type = 1;
        if (strstr($mime, "video/")){
            $temp_file_name = "{$filename}.{$file->getClientOriginalExtension()}";
            $file->storeAs('tmp', $temp_file_name);
            $thumb = "{$uploadPath}/thumbs/{$filename}.jpg";
            $thumb_file = FFMpeg::fromDisk('local')
                ->open("tmp/{$temp_file_name}")
                ->getFrameFromSeconds(1)
                ->export()
                ->getFrameContents();
            Storage::delete("tmp/{$temp_file_name}");
            
            $image_resize = Image::make($thumb_file);
            $type = 2;
        } else if (strstr($mime, "image/")){
            $thumb = "{$uploadPath}/thumbs/{$filename}." . $file->getClientOriginalExtension();
            $image_resize = Image::make($file->getRealPath());              
        }
        Storage::disk('s3')->put($thumb, $this->resizeImage($image_resize, $size));

        return [
            Storage::disk('s3')->url($filepath),
            Storage::disk('s3')->url($thumb), 
            $type
        ];
    }

    private function resizeImage($image, $requiredSize) {
        $width = $image->width();
        $height = $image->height();
    
        // Check if image resize is required or not
        if ($requiredSize >= $width && $requiredSize >= $height) return $image->stream();
    
        $newWidth;
        $newHeight;
    
        $aspectRatio = $width / $height;
        if ($aspectRatio >= 1.0) {
            $newWidth = $requiredSize;
            $newHeight = $requiredSize / $aspectRatio;
        } else {
            $newWidth = $requiredSize * $aspectRatio;
            $newHeight = $requiredSize;
        }
    
        $image->resize($newWidth, $newHeight)->stream();
        return $image;
    }
}