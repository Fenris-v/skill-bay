<?php

namespace App\Http\Controllers;

use App\Repository\OrdersRepository;
use App\Repository\ProductViewHistoryRepository;
use App\Repository\EloquentUserRepository;
use Illuminate\Contracts\View\View;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\{UserService, PreparePasswordService};
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * @param OrdersRepository $orders
     * @param UserRepository $users
     * @param ProductViewHistoryRepository $historyRepository
     * @return View
     */
    public function index(
        OrdersRepository $orders,
        EloquentUserRepository $usersRepository,
        ProductViewHistoryRepository $historyRepository
    ): View {
        $userId = auth()->id();

        $order = $orders->getLast($userId);

        $user = $usersRepository->getById($userId, ['name']);

        $history = $historyRepository->get($userId, 3);

        return view(
            'pages.account.account',
            compact('order', 'user', 'history')
        );
    }

    /**
     * @return View
     */
    public function show(): View
    {
        $user = auth()->user();
        return view('pages.account.profile',["user" => $user]); //$user->attachments->path
    }
    
    public function editProfile(AccountRequest $request, UserService $userService, PreparePasswordService $passwordService)
    {
        $user = auth()->user();
        if($request->hasFile('avatar')){
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

        $data = $request->validated();

        $data = $passwordService->checkPassword($data);

        $userService->updateUser($data, $user);
        return back()->with('success', __('user_messages.profile_edit_success'));
    }
    
    public function deleteAvatar()
    {
        $user = auth()->user();
        $avatar = Attachment::where("user_id", $user->id)->where("original_name", "avatar")->first();
        if($avatar != null){
            unlink($avatar->path);
            Attachment::where("user_id", $user->id)->where("original_name", "avatar")->delete();
        }
        return back();
    }
}
