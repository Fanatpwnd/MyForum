<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\UserInfo;

class AvatarController extends Controller
{
    public function load()
    {
        return view('main', ['type_page' => 'avatar']);
    }

    public function store(Request $request)
    {
        $path = $request->file('file')->store('public/avatars');
        UserInfo::where('user_id', $request->user()['id'])->update(['avatar_path' => Storage::url($path)]);
        return redirect('/');
    }
}
