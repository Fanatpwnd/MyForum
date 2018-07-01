<?php

namespace App\Http\Middleware;

use Closure;
use App\Message;
use App\Thread;

class DeleteControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO: Refactor
        if ($request->user()->isReader()) {
            return back();
        }

        if ($request->path() == 'DeleteMessage') {
            if ($request->user()['id'] != Message::find($request['id'])['user_id']) {
                return back();
            }
            if (Message::find($request['id'])->thread->messages->where('is_delete', false)->count() == 1) {
                Message::find($request['id'])->thread->update(['is_delete' => true]);
            }
        }
        else if ($request->path() == 'DeleteThread') {
            if ($request->user()['id'] != Thread::find($request['id'])['user_id']) {
                return back();
            }
        }
        else if ($request->path() == 'DeleteSection') {
            if (!$request->user()->isAdmin())
            {
                return back();
            }
        }


        return $next($request);
    }
}
