<?php

namespace Afiqiqmal\LaraPassPolicy\Observers;

use Illuminate\Database\Eloquent\Model;

class PasswordPolicyObserver
{
    public function created(Model $model)
    {
        $model->passwordHistories()->create([
            'password' => $model->password
        ]);
    }

    public function updated(Model $model)
    {
        if ($model->getChanges()['password'] ?? null) {
            $model->passwordHistories()->create([
                'password' => $model->password
            ]);
        }
    }
}