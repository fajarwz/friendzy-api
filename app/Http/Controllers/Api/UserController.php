<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function index()
    {
        return response(['users' => $this->user::where('id', '!=', Auth::id())->get()]);
    }

    public function show(User $user)
    {
        return response([
            'user' => $user,
            'isFriendsWith' => $this->user->is_friends_with($user->id),
            'friendRequestSentTo' => $this->user->has_pending_friend_request_sent_to($user->id),
            'friendRequestSentFrom' => $this->user->has_pending_friend_request_from($user->id),
        ]);
    }

    public function auth(Request $request)
    {
        return response($request->user());
    }
}
