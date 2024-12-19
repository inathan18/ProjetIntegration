@extends('layouts.app')

@section('titre', "Modification")

@section('contenu')

@section('body', "V3R-Blanc")

<div class="p-3 text-center"> <h1> Modifier mes informations financières </h1> </div>

<div class="container-fluid h-100">

    <div class="row text-center align-items-center justify-content-center" >
<form action="{{ route('Fournisseurs.storeFinancialInformation', [$fournisseur_actuel]) }}" method="POST"> 
    @csrf
    @method('PATCH') 
    <div class="p3"> 
        <label for="noTps" class="form-label">No TPS:</label> 
        <input type="text" id="noTps" name="noTps" class="form-control" value="{{($financialInformation->noTps ?? '')}}"> 
    </div> 
    <div class="p3">
        <label for="noTvq" class="form-label">No TVQ:</label> 
        <input type="text" id="noTvq" name="noTvq" class="form-control" value="{{($financialInformation->noTvq ?? '')}}"> 
    </div> 
    <div class="p3">
        <!--Possibilité de le programmer pour aller chercher des données de BD ou API -->
        <label for="conditionPaiement" class="form-label">Condition Paiement:</label> 
        <select name="conditionPaiement" class="form-control" id="conditionPaiement" style="border-radius: 10px; width:80%;">
            <option value="" selected disabled>Sélectionnez la condition de paiement</option>
            <option value="Z001" {{ ($financialInformation->conditionPaiement ?? '') === 'Z001' ? 'selected' : ''}}>Z001 - payable immédiatement sans déduction</option>
            <option value="Z115"{{ ($financialInformation->conditionPaiement ?? '') === 'Z115' ? 'selected' : ''}}>Z115 - payable immédiatement sans déduction, Date de base au 15 du mois suivant</option>
            <option value="Z152" {{ ($financialInformation->conditionPaiement ?? '') === 'Z152' ? 'selected' : ''}}>Z152 - dans les 15 jours 2% escompte, dans les 30 jours sans déduction</option>
            <option value="Z153" {{ ($financialInformation->conditionPaiement ?? '') === 'Z153' ? 'selected' : ''}}>Z153 - après entrée facture jusqu'au 15 du mois, jusqu'au 15 du mois suivant 2% escompte</option>
            <option value="Z210" {{ ($financialInformation->conditionPaiement ?? '') === 'Z210' ? 'selected' : ''}}>Z210 - dans les 10 jours 2% escompte, dans les 30 jours sans déduction</option>
            <option value="ZT15" {{ ($financialInformation->conditionPaiement ?? '') === 'ZT15' ? 'selected' : ''}}>ZT15 - dans les 15 jours sans déduction</option>
            <option value="ZT30" {{ ($financialInformation->conditionPaiement ?? '') === 'ZT30' ? 'selected' : ''}}>ZT30 - dans les 30 jours sans déduction</option>
            <option value="ZT45" {{ ($financialInformation->conditionPaiement ?? '') === 'ZT45' ? 'selected' : ''}}>ZT45 - dans les 45 jours sans déduction</option>
            <option value="ZT60" {{ ($financialInformation->conditionPaiement ?? '') === 'ZT60' ? 'selected' : ''}}>ZT60 - dans les 60 jours sans déduction</option>
        </select> 
    </div> 
    <div class="p3"> 
        <label for="devise" class="form-label">Devise:</label> 
        <select name="devise" class="form-control"id="devise" style="border-radius: 10px; width:80%;">
        <option value="" selected disabled>Sélectionnez la devise</option>
        <option value="CAD" {{ ($financialInformation->devise ?? '') === 'CAD' ? 'selected' : ''}}>CAD - Dollar Canadien</option>
        <option value="USD" {{ ($financialInformation->devise ?? '') === 'USD' ? 'selected' : ''}}>USD - Dollar des États-Unis</option> 
        </select>   
    </div> 
    <div class="p3"> 
        <label for="modeCommunication" class="form-label">Mode Communication:</label> 
        <select name="modeCommunication" class="form-control" id="modeCommunication" style="border-radius: 10px; width:80%;">
        <option value="" selected disabled>Sélectionnez le mode de communication</option>
        <option value="Courriel" {{ ($financialInformation->modeCommunication ?? '') === 'Courriel' ? 'selected' : ''}}>Courriel</option>
        <option value="Téléphone" {{ ($financialInformation->modeCommunication ?? '') === 'Téléphone' ? 'selected' : ''}}>Téléphone</option>
        </select> 
    </div> 
    <button class="btn text-white" style="background-color: #092D74;" type="submit">
            Soumettre
        </button>
        <button class="btn text-white" style="background-color: #092D74;" type="button" onclick="window.history.back();">
            Retour
        </button>
    </form>
</div>
</div>
</div>
@endsection