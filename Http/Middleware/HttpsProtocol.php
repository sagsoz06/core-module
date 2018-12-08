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
        if (!$request->secure() && config('app.env') === 'production' && config('app.secure')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}