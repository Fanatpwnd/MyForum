<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInfo;

class UserInfoController extends Controller
{
    public function getUser(int $id)
    {
        $content = UserInfo::where('user_id', $id)->get()[0];
        return view('main', ['content' => $content, 'type_page' => 'user']);
    }
}
