<?php

namespace SAAS\Domain\Account\Events;

use SAAS\Domain\Users\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PasswordUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Auth user instance.
     *
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param \SAAS\Domain\Users\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
