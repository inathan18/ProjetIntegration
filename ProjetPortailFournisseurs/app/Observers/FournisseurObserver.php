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
        unset($modifications['updated_at']);
    
        foreach ($modifications as $key => $newValue) {
            $oldValue = $fournisseur->getOriginal($key);
    
            if ($key === 'phone') {
                // Convertir les tableaux en chaînes lisibles pour la comparaison
                $oldValueString = is_array($oldValue) ? implode(', ', $oldValue) : $oldValue;
                $newValueString = is_array($newValue) ? implode(', ', $newValue) : $newValue;
    
                if ($oldValueString !== $newValueString) {
                    $changes[$key] = [
                        'old' => "- $oldValueString",
                        'new' => "+ $newValueString"
                    ];
                }
            } else {
                if ($oldValue !== $newValue) {
                    $changes[$key] = [
                        'old' => "- $oldValue",
                        'new' => "+ $newValue" 
                    ];
                }
            }
        }
    
        // Si le statut est refusé, on prend la raison du refus
        $historiqueStatut = 'M';
        $raisonRefus = null;
        if (array_key_exists('statut', $modifications) && $modifications['statut'] === 'R') {
            $raisonRefus = $fournisseur->raisonRefus ?: null;
        }

        if (array_key_exists('statut', $modifications)) {
            $historiqueStatut = $fournisseur->statut;
        }
    
        // Si des changements ont été effectués, on insère un enregistrement dans l'historique
        if (!empty($changes)) {
            Historique::create([
                'fournisseur_id' => $fournisseur->id,
                'statut' => $historiqueStatut,
                'modifie_par' => Auth::guard('usager')->user() ? Auth::guard('usager')->user()->email : 'systeme',
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
