<?php

namespace Afiqiqmal\LaraPassPolicy\Middleware;

use Afiqiqmal\LaraPassPolicy\Models\Contract\MustVerifyPasswordPolicy;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsurePasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() || ($request->user() instanceof MustVerifyPasswordPolicy && $request->user()->isPasswordExpired())) {
            return $request->expectsJson()
                ? abort(403, __(config('lara-pass-policy.messages.expired')))
                : Redirect::guest(URL::route($redirectToRoute ?: 'password_change.notice'));
        }

        return $next($request);
    }
}
