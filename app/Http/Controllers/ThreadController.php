<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Message;
use Illuminate\Http\RedirectResponse;

class ThreadController extends Controller
{
    public function addThread(Request $request)
    {
        $request->validate([
            'msg_body' => 'required|max:2000|min:100',
            'thread_name' => 'required|max:500:10'
        ]);

        $thread = $request->all();

        Thread::insert(['thread_name' => $thread['thread_name'],
        'user_id' => $request->user()['id'],
        'section_id' => $thread['section_id'],
        'is_delete' => false, 
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")]);

        $msg = $thread;
        $msg['msg_name'] = $msg['thread_name'];
        $msg['thread_id'] = Thread::where('thread_name', $thread['thread_name'])->where('is_delete', false)->orderBy('thread_id', 'desc')->first()['thread_id'];
        $msg['user_id'] = $request->user()['id'];
        MessageController::addFirstMessage($msg);

        //TODO: add first message in topic
        return back()->withInput(); 
    }

    public function deleteThread(Request $request)
    {
        $thread = $request->all();
        Thread::where('thread_id', $thread['id'] )->update(['is_delete' => true]);
        MessageController::deleteAllMessagesThisThread($thread['id']);
        return back()->withInput();
    }

    public function restoreThread(Request $request)
    {
        $thread = $request->all();
        Thread::where('thread_id', $thread['id'] )->update(['is_delete' => false]);
        MessageController::restoreAllMessagesThisThread($thread['id']);
        return back()->withInput();
    }

    public function getThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 0)->get();
        foreach ($threads as &$item) {
            $item['count'] = Message::where('thread_id', $item['thread_id'])->where('is_delete', false)->count();
        }
        unset($item);
        return view('main', ['content' => $threads, 'type_page' => 'threads']);
    }

    public function getDeletedThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 1)->get();
        return view('main', ['content' => $threads, 'type_page' => 'trash']);
    }
}