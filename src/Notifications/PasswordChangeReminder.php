<?php

namespace Afiqiqmal\LaraPassPolicy\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordChangeReminder extends Notification
{
    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($notifiable);
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  mixed  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($notifiable)
    {
        $days = $notifiable->passwordWillExpiredInDay();

        if ($days > 0) {
            return (new MailMessage)
                ->subject(Lang::get('Change Password Reminder'))
                ->line(Lang::get("Your password lifetime will expired in $days days. For Security Reason, Please update your password"));
        } else {
            return (new MailMessage)
                ->subject(Lang::get('Your Password Expired'))
                ->line(Lang::get("Your password lifetime is expired. For Security Reason, Please update your password"));
        }
    }
}
