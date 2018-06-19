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
        $thread = $request->all();

        Thread::insert(['thread_name' => $thread['thread_name'],
        'user_id' => $request->user()['id'],
        'section_id' => $thread['section_id'],
        'is_delete' => false, 
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")]);

        //TODO: add first message in topic

       
        //return $this->getThreads($thread['section_id']);
        return back()->withInput(); //TODO : redirect dont work
    }

    public function deleteThread(Request $request)
    {
        $thread = $request->all();
        Thread::where('thread_id', $thread['id'] )->update(['is_delete' => true]);
        $this->getThreads($thread['section_id']);
    }

    public function restoreThread(Request $request)
    {
        $thread_id = $request->all()['id'];
        Thread::where('thread_id', $thread_id )->update(['is_delete' => false]);
        
        $this->getThreads();
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
        return view('main', ['content' => $thread, 'type_page' => 'threads']);
    }
}
