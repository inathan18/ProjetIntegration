<?php

namespace App\Listeners;

use App\Events\AccountModified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Notifications\ChangementFournisseur;

class SendAccountModificationEmail
{

    /**
     * Handle the event.
     */
    public function handle(AccountModified $event)
    {
        $event->user->notify(new ChangementFournisseur());
    }
}
