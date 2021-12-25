<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public $user; 

    public function __construct()
    {
        $this->user = new User;
    }

    public function index()
    {
        return response([
            'friends' => $this->user->friends(),
            'requests' => $this->user->pending_friend_requests(),
        ]);
    }

    public function store(Request $request, User $user) 
    {
        return $this->user->add_friend($user->id);
    }

    public function update(Request $request, User $user) 
    {
        return $this->user->accept_friend($user->id);
    }

    public function deny(Request $request, User $user) 
    {
        return $this->user->deny_friend($user->id);
    }

    public function destroy(Request $request, User $user) 
    {
        return $this->user->deny_friend($user->id);
    }

}
