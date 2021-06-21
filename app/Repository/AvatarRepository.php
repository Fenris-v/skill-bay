<?php
namespace App\Repository;
use App\Models\{Attachment, User};

class AvatarRepository
{
    public function getUserAvatar(User $user)
    {
        return Attachment::where("user_id", $user->id)->where("original_name", "avatar")->first();
    }

    public function deleteUserAvatar(User $user)
    {
        Attachment::where("user_id", $user->id)->where("original_name", "avatar")->delete();
    }

    public function createAvatar(array $imageArr)
    {
        Attachment::create($imageArr);
    }
}