<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Media;
use  App\Services\User\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    function getAllMedia($id = null){
        $media = MediaService::getAllMedia($id);
        return $this->responseJSON($media);
    }

    function addOrUpdateMedia(Request $request, $id = null){
        $media = new Media();
        if($id){
            $media = MediaService::getAllMedia($id);
        }

        $data = $request->all();

        $media = MediaService::createOrUpdateMedia($data, $media);
        if($media){
            return $this->responseJSON($media);
        }
        return $this->responseJSON($media, "error", 400);

    }
}
