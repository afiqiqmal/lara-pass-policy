<?php

namespace Afiqiqmal\LaraPassPolicy\Models\Traits;

use Afiqiqmal\LaraPassPolicy\Exceptions\PasswordHistoryException;
use Afiqiqmal\LaraPassPolicy\Notifications\PasswordChangeReminder;
use Illuminate\Support\Facades\Hash;

trait HasPasswordPolicy
{
    public static function bootHasPasswordPolicy()
    {
        static::observe(app(config('lara-pass-policy.observer')));
    }

    public function passwordHistories()
    {
        return $this->morphMany(app(config('lara-pass-policy.model')), 'authenticable');
    }

    public function isPasswordExpired(): bool
    {
        $latest_history = $this->passwordHistories()->latest()->first();
        if (!$latest_history) {
            return true;
        }

        return $latest_history->created_at->diffInDays(now()) > config('lara-pass-policy.password_lifetime');
    }

    public function getEmailForEmailReminder(): string
    {
        return $this->email;
    }

    public function getLastPassword(): ?string
    {
        return $this->passwordHistories()->latest()->first()->password ?? null;
    }

    public function sendEmailPasswordChangeReminderNotification()
    {
        $this->notify(new PasswordChangeReminder());
    }

    public function isPasswordHistoryMatchWith($new_password): bool
    {
        return $this->passwordHistories()
                ->latest()
                ->take(config('lara-pass-policy.depth'))
                ->pluck('password')->filter(function ($password) use ($new_password) {
                    return Hash::check($new_password, $password);
                })->count() > 0;
    }

    public function changePasswordTo($new_password)
    {
        if ($this->isPasswordHistoryMatchWith($new_password)) {
            throw new PasswordHistoryException(__(config('lara-pass-policy.messages.same-password')));
        }

        $new_password = Hash::make($new_password);

        if ($this->forceFill([
            'password' => $new_password,
        ])->save()) {
            $this->passwordHistories()->create([
                'password' => $new_password
            ]);

            return true;
        }

        return false;
    }
}