<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Thread;

class MessageController extends Controller
{
    public function addMessage(Request $request)
    {
        $msg = $request->all();

        if (empty(Thread::where('thread_id', $msg['thread_id'])->get()->toArray())){
            return view('testing', ['content' => 'Thread does not exist']); //TODO: change view
        }

        Message::insert(['msg_name' => $msg['msg_name'],
        'msg_body' => $msg['msg_body'],
        'user_id' => $msg['user_id'],
        'thread_id' => $msg['thread_id'],
        'is_delete' => false, 
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")]);

        return view('testing', ['content' => 'Message created']); //TODO: change view
    }

    public function deleteMessage(Request $request)
    {
        $msg_id = $request->all()['id'];
        Message::where('msg_id', $msg_id )->update(['is_delete' => true]);
        return view('testing', ['content' => 'Message deleted']); //TODO: change view
    }

    public function restoreMessage(Request $request)
    {
        $msg_id = $request->all()['id'];
        Message::where('msg_id', $msg_id )->update(['is_delete' => false]);
        return view('testing', ['content' => 'Message restored']); //TODO: change view
    }

    public function getMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 0)->get();
        return $msgs;
    }

    public function getDeletedMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 1)->get();
        return $msgs;
    }

    public function Debug()
    {
        return empty(Thread::where('thread_id', 2)->get()->toArray())? "true" : "false";
    }
}
