<?php

namespace App\Listeners;

use App\Events\StatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ChangementStatut;

class SendStatusChangeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StatusChanged $event): void
    {
        $event->fournisseur->notify(new ChangementStatut());
    }
}
