<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Registered;
use App\Models\Role;

class AssignDefaultRole implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $defaultRole = Role::where('name', 'employee')->first();

        if ($defaultRole) {
            $event->user->roles()->attach($defaultRole);
        }
    }
}
