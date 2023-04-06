<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        // $user = auth()->user();

        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $path = $avatar->storeAs('avatars', $filename, 'public');

        // $user->avatar = $path;
        // $user->save();

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'avatar' => $path
        ]);
    }
}
