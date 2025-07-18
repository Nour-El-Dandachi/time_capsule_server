<?php

namespace App\Services\User;

use App\Models\Media;

class MediaService
{

    static function getAllMedia($id = null)
    {
        if (!$id) {
            return Media::all();
        }
        return Media::find($id);
    }

    static function createOrUpdateMedia($data, $media)
    {
        $media->capsule_id = 0;
        $media->type = $data["type"] ?? $media->type;
        $media->file_path = $data["file_path"] ?? $media->file_path;
        
        $media->save();
        return $media;
    }
}
