<?php

namespace App\Services\User;

use App\Models\Capsule;

class CapsuleService
{

    static function getAllCapsules($id = null)
    {
        if (!$id) {
            return Capsule::all();
        }
        return Capsule::find($id);
    }

    static function getRevealedCapsules($id = null)
    {
        if ($id) {
            return Capsule::where("user_id", $id)->where("is_revealed", 1)->get();
        }
        return Capsule::where("visibility", "public")->where("is_revealed", 1)->get();
    }

    static function getClosedCapsules($id)
    {
        if ($id) {
            return Capsule::where("user_id", $id)->where("is_revealed", 0)->get();
        }
    }

    static function createOrUpdateCapsules($data, $capsule)
    {
        $capsule->user_id = 0;
        $capsule->title = $data["title"] ?? $capsule->title;
        $capsule->message = $data["message"] ?? $capsule->message;
        $capsule->gps_location = $data["gps_location"] ?? $capsule->gps_location;
        $capsule->ip_address = $data["ip_address"] ?? $capsule->ip_address;
        $capsule->country = $data["country"] ?? $capsule->country;
        $capsule->reveal_date = $data["reveal_date"] ?? $capsule->reveal_date;
        $capsule->visibility = $data["visibility"] ?? $capsule->visibility;
        $capsule->mode = $data["mode"] ?? $capsule->mode;
        $capsule->color = $data["color"] ?? $capsule->color;
        $capsule->emoji = $data["emoji"] ?? $capsule->emoji;
        $capsule->is_revealed = $data["is_revealed"] ?? $capsule->is_revealed;
        $capsule->save();
        return $capsule;
    }
}
