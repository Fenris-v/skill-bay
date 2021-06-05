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
        return view('pages.account.profile',["user" => $user]);
    }
    
    public function editProfile(AccountRequest $request, UserService $userService, PreparePasswordService $passwordService)
    {
        $user = auth()->user();
        if($request->has('avatar')){
            $path = $request->file('avatar')->storeAs(
                'avatars', $user->id . '.'. $request->file('avatar')->extension()
            );
            $imageArr = [
                'name' => pathinfo($path)['filename'],
                'original_name' => "avatar",
                'mime' => mime_content_type ($path),
                'extension' => $request->file('avatar')->extension(),
                'path' => $path,
                'user_id' => $user->id,
                'size' => filesize($path),
                'hash' => sha1_file($path),
            ];
            Attachment::where("user_id", $user->id)->where("original_name", "avatar")->delete();
            $avatar = Attachment::create($imageArr);
        }

        $data = $request->validated();

        $data = $passwordService->checkPassword($data);

        $userService->updateUser($data, $user);
        return back()->with('success', __('user_messages.profile_edit_success'));
	}
}
