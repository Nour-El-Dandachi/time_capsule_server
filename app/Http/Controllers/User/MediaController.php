<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\User\MediaService;
use Illuminate\Http\Request;
use Exception;

class MediaController extends Controller
{
    public function getAllMedia($id = null)
    {
        try {
            $media = MediaService::getAllMedia($id);
            return $this->responseJSON($media);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to retrieve media.", 500);
        }
    }

    public function getAllMediaByCapsuleId($capsule_id)
    {
        try {
            $media = MediaService::getAllMediaByCapsuleId($capsule_id);

            if ($media && count($media) > 0) {
                return $this->responseJSON($media);
            }

            return $this->responseJSON([], "No media found for this capsule.", 404);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to load capsule media.", 500);
        }
    }

    public function addOrUpdateMedia(Request $request, $id = null)
    {
        try {
            $media = new Media();

            if ($id) {
                $media = MediaService::getAllMedia($id);
                if (!$media) {
                    return $this->responseJSON(null, "Media not found.", 404);
                }
            }

            $data = $request->all();
            $media = MediaService::createOrUpdateMedia($data, $media);

            if ($media) {
                return $this->responseJSON($media);
            }

            return $this->responseJSON(null, "Failed to save media.", 400);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Server error while saving media.", 500);
        }
    }
}
