<?php

namespace Afiqiqmal\LaraPassPolicy\Controllers;

use Afiqiqmal\LaraPassPolicy\Events\PasswordChanged;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PasswordExpiredChangeController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        return !$request->user()->isPasswordExpired()
            ? redirect()->intended(config('lara-pass-policy.redirects.password-changed'))
            : view(config('lara-pass-policy.views.password-changed'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'current_password' => ['required'],
            'password' => ['required', 'string', config('lara-pass-policy.strict', new \Illuminate\Validation\Rules\Password(8)), 'confirmed',
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