<?php

namespace App\Services\User;

use App\Models\Capsule;
use Stevebauman\Location\Facades\Location;

class CapsuleService
{

    static function getAllCapsules($id = null)
    {
        if (!$id) {
            return Capsule::all();
        }
        return Capsule::find($id);
    }

    static function getRevealedCapsules($user_id = null)
    {
        if ($user_id) {
            return Capsule::where("user_id", $user_id)->where("is_revealed", 1)->get();
        }
        return Capsule::where("visibility", "public")->where("is_revealed", 1)->get();
    }

    static function getClosedCapsules($user_id)
    {
        if ($user_id) {
            return Capsule::where("user_id", $user_id)->where("is_revealed", 0)->get();
        }
    }

    static function createOrUpdateCapsules($data, $capsule)
    {
        if ($position = Location::get()) {
           $country = $position->countryName;
           $ip_address = $position->ip;
           $gps_location = $position->latitude . ',' . $position->longitude;
        } else {
            return "error";
        }

        $capsule->user_id = $data["user_id"] ?? $capsule->user_id;
        $capsule->title = $data["title"] ?? $capsule->title;
        $capsule->message = $data["message"] ?? $capsule->message;
        $capsule->gps_location = $gps_location ?? $capsule->gps_location;
        $capsule->ip_address = $ip_address ?? $capsule->ip_address;
        $capsule->country = $country ?? $capsule->country;
        $capsule->reveal_date = $data["reveal_date"] ?? $capsule->reveal_date;
        $capsule->visibility = $data["visibility"] ?? $capsule->visibility;
        $capsule->mode = $data["mode"] ?? $capsule->mode;
        $capsule->color = $data["color"] ?? $capsule->color;
        $capsule->emoji = $data["emoji"] ?? $capsule->emoji;
        $capsule->is_revealed = $data["is_revealed"] ?? $capsule->is_revealed;
        $capsule->save();
        return $capsule;
    }

    static function getByEmoji($emoji){

        if ($emoji) {
            return Capsule::where("visibility", "public")->where("is_revealed", 1)->where("emoji", $emoji)->get();
        }
        else{
            return null;
        }
    }
}
