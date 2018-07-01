<?php

namespace App\Http\Middleware;

use Closure;

class EditControl
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
        //TODO: refactor
        if ($request->user()->isReader()) {
            return back();
        }
        if ($request->path() == 'EditMessage') {
            if ($request->user()->isVIP() && $request->user()['id'] != Message::find($request['id'])['user_id']) {
                return back();
            }
        }
        else if ($request->path() == 'EditThread') {
            if ($request->user()->isVIP() && $request->user()['id'] != Thread::find($request['id'])['user_id']) {
                return back();
            }
        }
        else if ($request->path() ==  'ChangeRole') {
            if (!$request->user()->isAdmin())
            {
                return back();
            }
        }
        return $next($request);
    }
}
