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
use App\Services\AvatarService;

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
    
    public function editProfile(AccountRequest $request, UserService $userService, PreparePasswordService $passwordService, AvatarService $avatarService)
    {
        $user = auth()->user();
        if($request->hasFile('avatar')){
            $avatarService->createAvatar($request, $user);
        }

        $data = $request->validated();

        $data = $passwordService->checkPassword($data);

        $userService->updateUser($data, $user);
        return back()->with('success', __('user_messages.profile_edit_success'));
    }
    
    public function deleteAvatar(AvatarService $avatarService)
    {
        $user = auth()->user();
        $avatarService->deleteAvatar($user);
        return back();
    }
}
