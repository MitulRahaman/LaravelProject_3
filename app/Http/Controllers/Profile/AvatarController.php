<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));

        if($request->user()->avatar)
        {
            Storage::disk('public')->delete($request->user()->avatar);
        }

        auth()->user()->update(['avatar'=> $path]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
