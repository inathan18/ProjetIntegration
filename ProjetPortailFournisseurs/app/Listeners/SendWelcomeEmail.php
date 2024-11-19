<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\BienvenueNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\Fournisseur;

class SendWelcomeEmail
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
    public function handle(Verified $event): void
    {
        $user = $event->fournisseur;
        Mail::to($user->email)->send(new BienvenueNotification($user));
    }
}
