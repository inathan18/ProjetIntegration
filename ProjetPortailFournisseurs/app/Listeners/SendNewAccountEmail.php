<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NouveauFournisseur;
use App\Models\Usager;
use Illuminate\Support\Facades\Log;

class SendNewAccountEmail
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(AccountCreated $event)
    {
        $responsable = Usager::where('role', 'responsable')->first();
        //Log::Debug($responsable);
        //Log::Debug($event->fournisseur);
        if($responsable){
            $responsable->notify(new NouveauFournisseur($event->fournisseur));
        }
        
    }
}
