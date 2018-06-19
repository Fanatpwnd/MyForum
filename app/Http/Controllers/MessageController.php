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
        'user_id' => $request->user()['id'],
        'thread_id' => $msg['thread_id'],
        'is_delete' => false, 
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")]);

        
        $this->getMessages($msg['thread_id']);
    }

    public function deleteMessage(Request $request)
    {
        $msg = $request->all();
        Message::where('msg_id', $msg['id'] )->update(['is_delete' => true]);
        
        $this->getMessages($msg['thread_id']);
    }

    public function restoreMessage(Request $request)
    {
        $msg = $request->all();
        Message::where('msg_id', $msg['id'] )->update(['is_delete' => false]);
        
        $this->getMessages($msg['thread_id']);
    }

    public function getMessages(int $thread_id)
    {
        $section = Thread::where('thread_id', $thread_id)->get()[0];
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 0)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages', 'section_id' => $section['section_id']]);
    }

    public function getDeletedMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 1)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages']);
    }

    public function Debug(Request $request)
    {
        return $request->user();
    }
}
