<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class ThreadController extends Controller
{
    public function addThread(Request $request)
    {
        $thread = $request->all();

        Thread::insert(['thread_name' => $thread['thread_name'],
        'user_id' => $thread['user_id'],
        'section_id' => $thread['section_id'],
        'is_delete' => false, 
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")]);

        return view('testing', ['content' => 'Thread created']); //TODO: change view
    }

    public function deleteThread(Request $request)
    {
        $thread_id = $request->all()['id'];
        Thread::where('thread_id', $thread_id )->update(['is_delete' => true]);
        return view('testing', ['content' => 'Thread deleted']); //TODO: change view
    }

    public function restoreThread(Request $request)
    {
        $thread_id = $request->all()['id'];
        Thread::where('thread_id', $thread_id )->update(['is_delete' => false]);
        return view('testing', ['content' => 'Thread restored']); //TODO: change view
    }

    public function getThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 0)->get();
        return $threads;
    }

    public function getDeletedThreads(int $section_id)
    {
        $threads = Thread::where('section_id', $section_id)->where('is_delete', 1)->get();
        return $threads;
    }
}
