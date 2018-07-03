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
        return view('main', ['content' => $content, 'type_page' => 'user']);
    }

    public function selectRole(Request $request)
    {
        $result = UserInfo::where('id',$request['id'])->update(['policy' => $request['role']]);
        //TODO: Why don't work "UserInfo::find($request['id'])->update(['policy' => $request['role']])?
        return back();
    }

    public function editBio(Request $request)
    {
        UserInfo::where('id', $request['id'])->update(['bio' => $request['bio']]);
        return back();
    }
}
