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
            'body' => 'required|max:2000|min:10',
        ]);

        Message::create([   'body'      => $request['body'],
                            'user_id'   => $request->user()['id'],
                            'thread_id' => $request['thread_id']
                            ]);

        return back()->withInput();
    }

    public function deleteMessage(Request $request)
    {   
        Message::where('id', $request['id'] )->update(['is_delete' => true]);
        return back()->withInput();
    }

    public function editMessage(Request $request)
    {
        Message::find($request['id'])->update(['body' => $request['body']]);
        return $this->getSections(); 
    }

    public function restoreMessage(Request $request)
    {
        Message::where('id', $request['id'] )->update(['is_delete' => false]);
        return back()->withInput();
    }

    public function getMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 0)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages', 'thread_id' => $thread_id, 'section_id' => Thread::find($thread_id)->section['id']]);
        //TODO: Remove var 'section_id'
    }

    public function getDeletedMessages(int $thread_id)
    {
        $msgs = Message::where('thread_id', $thread_id)->where('is_delete', 1)->get();
        return view('main', ['content' => $msgs, 'type_page' => 'messages']);
    }
}
