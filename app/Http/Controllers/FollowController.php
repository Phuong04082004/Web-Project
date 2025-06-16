<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class FollowController extends Controller
{
    public function toggleFollow(Request $request, User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id === $user->id) {
            return response()->json(['error' => 'Cannot follow yourself.'], 403);
        }

        if ($authUser->isFollowing($user)) {
            $authUser->unfollow($user);
            $following = false;
        } else {
            $authUser->follow($user);
            $following = true;
        }

        return response()->json([
            'following' => $following,
            'followersCount' => $user->followers()->count(),
        ]);
    }
}
