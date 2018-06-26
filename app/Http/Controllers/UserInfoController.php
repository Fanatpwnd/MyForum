<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;
use Illuminate\Support\Facades\Storage;

class UserInfoController extends Controller
{
    public function getUser(int $id)
    {
        $content = UserInfo::where('user_id', $id)->get()[0];
        //$content['avatar_path'] = Storage::url($content['avatar_path']);
        return view('main', ['content' => $content, 'type_page' => 'user']);
    }
}
