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

        $thread = Thread::create([
                            'title'         => $request['thread_name'],
                            'user_id'       => $request->user()['id'],
                            'section_id'    => $request['section_id'],
                            'is_delete'     => false]);

        Message::create([   'body'      => $request['msg_body'], 
                            'user_id'   => $request->user()['id'],
                            'thread_id' => $thread['id'],
                            'is_delete' => false]);

        return back()->withInput(); 
    }

    public function deleteThread(Request $request)
    {
        $thread = Thread::find($request['id']);
        $thread->update(['is_delete' => true]);
        $thread->messages->transform(function ($item, $key) {
            $item['is_delete'] = true;
        });
        return back()->withInput();
    }

    public function restoreThread(Request $request)
    {
        $thread = Thread::find($request['id']);
        $thread->update(['is_delete' => false]);
        $thread->messages->transform(function ($item, $key) {$item['is_delete'] = false;});
        return back()->withInput();
    }

    public function getThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 0)->get();
        return view('main', ['content' => $threads, 'type_page' => 'threads']);
    }

    public function getDeletedThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 1)->get();
        return view('main', ['content' => $threads, 'type_page' => 'trash']);
    }
}