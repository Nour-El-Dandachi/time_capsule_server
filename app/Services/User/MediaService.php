<?php

namespace App\Services\User;

use App\Models\Media;

use App\Models\Capsule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{

    static function getAllMedia($id = null)
    {
        if (!$id) {
            return Media::all();
        }
        return Media::find($id);
    }

    static function getAllMediaByCapsuleId($capsule_id){
        $capsule = Capsule::find($capsule_id);
        $media = $capsule->media;

        return $media;
    }

    static function createOrUpdateMedia($data, $media){
        if (isset($data['base64']) && isset($data['file_name']) && isset($data['type'])) {
            $base64String = $data['base64'];

            
            if (Str::contains($base64String, ';base64,')) {
                [$meta, $base64String] = explode(';base64,', $base64String);
            }

            $decoded = base64_decode($base64String);

            $filename = uniqid() . '_' . preg_replace('/\s+/', '_', $data['file_name']);
            $folder = $data['type'] === 'image' ? 'capsule_images' : 'capsule_audios';
            $fullPath = $folder . '/' . $filename;

            Storage::disk('public')->put($fullPath, $decoded);

            

            $media->file_path = $fullPath;
        }

        $media->capsule_id = $data['capsule_id'] ?? $media->capsule_id;
        $media->type = $data['type'] ?? $media->type;

        $media->save();
        return $media;
    }
}
