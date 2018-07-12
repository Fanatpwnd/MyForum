<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
        //dd($request->locale);
        if ($request->locale) {
            \App::setLocale($request->locale);
        } else {
            $availableLangs = ['ru', 'en'];
            $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLangs as $lang) {
                if(in_array($lang, $userLangs)) {
                    \App::setLocale($lang);
                    //$request->locale = $lang;
                    break;
                }
            }
        }
        return $next($request);
    }
}
