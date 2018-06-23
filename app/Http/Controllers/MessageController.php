<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Thread;

class MessageController extends Controller
{
    public function addMessage(Request $request)
    {
        $request->validate([
            'msg_body' => 'required|max:2000|min:100',
            'msg_name' => 'required|max:500|min:10'
        ]);

        if (empty(Thread::where('thread_id', $msg['thread_id'])->get()->toArray())){
            return view('testing', ['content' => 'Thread does not exist']); //TODO: change view
        }

        Message::create([   'body'      => $msg['msg_body'],
                            'user_id'   => $request->user()['id'],
                            'thread_id' => $msg['thread_id'],
                            'is_delete' => false]);

        return back()->withInput();
    }

    public function deleteMessage(Request $request)
    {
        Message::where('id', $request['id'] )->update(['is_delete' => true]);
        return back()->withInput();
    }

    public function restoreMessage(Request $request)
    {
        Message::where('id', $request['id'] )->update(['is_delete' => false]);
        return back()->withInput();
    }

    public function getMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 0)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages']);
    }

    public function getDeletedMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 1)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages']);
    }
}
