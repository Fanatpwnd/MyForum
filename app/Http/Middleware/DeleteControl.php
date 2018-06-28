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
        
        //TODO: Check for an empty thread

        if ($request->path() == 'DeleteMessage') {
            if ($request->user()['id'] != Message::find($request['id'])['user_id']) {
                return back();
            }
        }
        else if ($request->path() == 'DeleteThread') {
            if ($request->user()['id'] != Thread::find($request['id'])['user_id']) {
                return back();
            }
        }

        return $next($request);
    }
}
