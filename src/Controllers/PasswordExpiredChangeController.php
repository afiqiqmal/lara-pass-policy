<?php

namespace Afiqiqmal\LaraPassPolicy\Controllers;

use Afiqiqmal\LaraPassPolicy\Events\PasswordChanged;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordExpiredChangeController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function index(Request $request)
    {
        if (! $request->user()->isPasswordExpired()) {
            return redirect()->intended(config('lara-pass-policy.redirects.password-changed'));
        }

        $view = config('lara-pass-policy.views.password-changed');

        return is_callable('inertia') ? inertia($view) : view($view);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'current_password' => ['required'],
            'password' => ['required', 'string', 'confirmed', (new Password(8))::defaults(),
                function ($attribute, $value, $fail) {
                    if (request()->user()->isPasswordHistoryMatchWith($value)) {
                        $fail(__(config('lara-pass-policy.messages.same-password')));
                    }
                }
            ],
        ])->validate();

        if (!$request->user()->isPasswordExpired()) {
            return $request->wantsJson()
                ? new JsonResponse('', 204)
                : redirect()->intended(config('lara-pass-policy.redirects.password-changed'));
        }

        if ($request->user()->changePasswordTo($request->password)) {
            event(new PasswordChanged($request->user()));
        }

        return $request->wantsJson()
            ? new JsonResponse('', 202)
            : redirect()->intended(config('lara-pass-policy.redirects.password-changed'));
    }

}