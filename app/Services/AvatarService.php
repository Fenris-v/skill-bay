<?php
namespace App\Services;
use App\Models\{Attachment, User};
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Storage;

class AvatarService{
    public function createAvatar(AccountRequest $request, User $user)
    {
        $path = $request->file('avatar')->storeAs(
            'public/avatars', $user->id . '.'. $request->file('avatar')->extension()
        );
        $full_path = Storage::path("public/avatars/".$user->id . '.'. $request->file('avatar')->extension());
        $name = Storage::url('avatars/'. $user->id . '.'. $request->file('avatar')->extension());
        $imageArr = [
            'name' => $name,
            'original_name' => "avatar",
            'mime' => mime_content_type ($full_path),
            'extension' => $request->file('avatar')->extension(),
            'path' => $full_path,
            'user_id' => $user->id,
            'size' => filesize($full_path),
            'hash' => sha1_file($full_path),
        ];
        $avatar = Attachment::where("user_id", $user->id)->where("original_name", "avatar")->first();
        if($avatar != null){
            if($avatar->path != $full_path){
                unlink($avatar->path);
            }
            Attachment::where("user_id", $user->id)->where("original_name", "avatar")->delete();
        }
        Attachment::create($imageArr);
    }

    public function deleteAvatar(User $user)
    {
        $avatar = Attachment::where("user_id", $user->id)->where("original_name", "avatar")->first();
        if($avatar != null){
            unlink($avatar->path);
            Attachment::where("user_id", $user->id)->where("original_name", "avatar")->delete();
        }
    }
}