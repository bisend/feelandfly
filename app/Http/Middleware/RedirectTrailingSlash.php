<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 12.02.2018
 * Time: 12:19
 */

namespace App\Http\Middleware;


use Closure;

class RedirectTrailingSlash
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
        if (preg_match('/.+\/$/', $request->getRequestUri()))
        {
            return redirect(rtrim($request->getRequestUri(), '/'), 301);
        }

        return $next($request);
    }
}