<?php

namespace App\Http\Middleware;

use App;
use Closure;
use View;

class LocaleMiddleware {
    public function handle($request, Closure $next) {
        $language = $request->route()->parameter('lang');
        App::setLocale($language);
        View::share('lang', $language);
        return $next($request);
    }
}