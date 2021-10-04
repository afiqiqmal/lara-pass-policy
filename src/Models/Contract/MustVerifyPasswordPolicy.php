<?php

namespace Afiqiqmal\LaraPassPolicy\Models\Contract;

interface MustVerifyPasswordPolicy
{
    /**
     * Determine if the user's password expired or not.
     *
     * @return bool
     */
    public function isPasswordExpired(): bool;

    /**
     * Send the email reminder notification to change password.
     *
     * @return void
     */
    public function sendEmailPasswordChangeReminderNotification();

    /**
     * Get the email address that should be used for reminder.
     *
     * @return string
     */
    public function getEmailForEmailReminder(): string;

    /**
     * Get last password saved from user's password history.
     *
     * @return string|null
     */
    public function getLastPassword(): ?string;
}