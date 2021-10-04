<?php

namespace Afiqiqmal\LaraPassPolicy\Commands;

use Illuminate\Console\Command;

class LaraPasswordChangeReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pass-policy-reminder {model=App\Models\User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To trigger reminder to change password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (method_exists(app($this->argument('model')), 'isPasswordExpired') ){
            app($this->argument('model'))->query()->with('passwordHistories')->get()->filter(function ($user) {
                return $user->isPasswordExpired() || in_array($user->passwordWillExpiredInDay(), config('lara-pass-policy.reminder_password_to_change', [1]));
            })->each(function ($user) {
                $user->sendEmailPasswordChangeReminderNotification();
            });
        }

        return 0;
    }
}