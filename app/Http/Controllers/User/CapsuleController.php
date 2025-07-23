<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use App\Services\User\CapsuleService;
use Illuminate\Http\Request;
use Exception;

class CapsuleController extends Controller
{
    public function getAllCapsules($id = null)
    {
        try {
            $capsules = CapsuleService::getAllCapsules($id);
            return $this->responseJSON($capsules);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to retrieve capsules.", 500);
        }
    }

    public function getRevealedCapsules($user_id = null)
    {
        try {
            $capsules = CapsuleService::getRevealedCapsules($user_id);
            return $this->responseJSON($capsules);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to retrieve revealed capsules.", 500);
        }
    }

    public function getClosedCapsules($user_id)
    {
        try {
            $capsules = CapsuleService::getClosedCapsules($user_id);
            return $this->responseJSON($capsules);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to retrieve closed capsules.", 500);
        }
    }

    public function addOrUpdateCapsule(Request $request, $id = null)
    {
        try {
            $capsule = new Capsule;

            if ($id) {
                $capsule = CapsuleService::getAllCapsules($id);
                if (!$capsule) {
                    return $this->responseJSON(null, "Capsule not found.", 404);
                }
            }

            $data = $request->all();
            $capsule = CapsuleService::createOrUpdateCapsules($data, $capsule);

            if ($capsule) {
                return $this->responseJSON($capsule);
            }

            return $this->responseJSON(null, "Failed to save capsule.", 400);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Server error while saving capsule.", 500);
        }
    }

    public function getByEmoji($emoji)
    {
        try {
            $capsules = CapsuleService::getByEmoji($emoji);

            if ($capsules && count($capsules) > 0) {
                return $this->responseJSON($capsules);
            }

            return $this->responseJSON([], "No capsules found with this emoji.", 404);
        } catch (Exception $e) {
            return $this->responseJSON(null, "Failed to retrieve capsules by emoji.", 500);
        }
    }
}
