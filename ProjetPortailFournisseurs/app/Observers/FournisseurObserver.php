<?php

namespace App\Observers;

use App\Models\Fournisseur;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FournisseurObserver
{
    public function saved(Fournisseur $fournisseur)
    {
        // Vérifier que le statut est valide
        if (empty($fournisseur->statut)) {
            \Log::error('Le statut du fournisseur est vide ou invalide.', ['fournisseur_id' => $fournisseur->id]);
            throw new \Exception('Le statut du fournisseur est vide ou invalide.');
        }
    
        $modifications = $fournisseur->getDirty();
        $changes = [];
    
        // Collecte des modifications
        foreach ($modifications as $key => $newValue) {
            $oldValue = $fournisseur->getOriginal($key);
            $changes[$key] = [
                'old' => "- $oldValue",
                'new' => "+ $newValue"
            ];
        }
    
        // Si le statut est refusé, on prend la raison du refus
        $raisonRefus = null;
        if (array_key_exists('statut', $modifications) && $modifications['statut'] === 'R') {
            $raisonRefus = $fournisseur->raisonRefus ?: null;
        }
    
        // Si des changements ont été effectués, on insère un enregistrement dans l'historique
        if (!empty($changes)) {
            Historique::create([
                'fournisseur_id' => $fournisseur->id,
                'statut' => $fournisseur->statut, 
                'modifie_par' => Auth::user()->name ?? 'systeme',
                'modifications' => json_encode($changes),
                'raisonRefus' => $raisonRefus,  
            ]);
        }
    }
    
    


    /**
     * Handle the Fournisseur "created" event.
     */
    public function created(Fournisseur $fournisseur): void
    {
        //
    }

    /**
     * Handle the Fournisseur "updated" event.
     */
    public function updated(Fournisseur $fournisseur): void
    {
        //
    }

    /**
     * Handle the Fournisseur "deleted" event.
     */
    public function deleted(Fournisseur $fournisseur): void
    {
        //
    }

    /**
     * Handle the Fournisseur "restored" event.
     */
    public function restored(Fournisseur $fournisseur): void
    {
        //
    }

    /**
     * Handle the Fournisseur "force deleted" event.
     */
    public function forceDeleted(Fournisseur $fournisseur): void
    {
        //
    }
}
