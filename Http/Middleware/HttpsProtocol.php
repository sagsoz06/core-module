<?php namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol {

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && env('APP_ENV') === 'production' && env('APP_SECURE')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}