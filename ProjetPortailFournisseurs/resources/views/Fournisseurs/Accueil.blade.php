@extends('layouts.app')

@section('titre', "Accueil")

@section('contenu')

@section('body', "V3R-Gris")

<div class="container-fluid">
<div class="row">
<div class="col-6">
<form method="POST" action="{{ route('Fournisseur.logout') }}" class="d-flex align-items-center">
    @csrf
    <button type="submit" class="btn btn-link nav-link d-flex align-items-center" style="display: inline; padding: 0; margin: 0; border: none;">
        <i class="fas fa-sign-out-alt me-2"></i>
        Déconnexion
    </button>
</form>

    <div class="row">
        <div class="col-6">
            <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Compagnie </h3>
                </div>
                <div class="card-content">
                    <p> Nom: <br> {{$fournisseur_actuel->name}} </p><hr>
                    <p> Adresse: <br> {{$fournisseur_actuel->address}} </p><hr>
                    <p> Ville: <br> {{$fournisseur_actuel->city}} </p><hr>
                    <p> Province: <br> {{$fournisseur_actuel->province}} </p><hr>
                    <p> Pays: <br> {{$fournisseur_actuel->country}} </p><hr>
                    <p> Telephone {{$telephone[0]}}: <br> {{$telephone[1]}} </p><hr>
                </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                    <div class="card-container">
                        <div class="persoCard">
                            <div class="card-top text-center">
                                <h3> Services Fournis </h3>
                            </div>
                            <div class="card-content">

                                @foreach($produitsServices as $produitService)
                                    <li>{{ $produitService }}</li><hr>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-1"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                    <div class="card-container">
                        <div class="persoCard">
                            <div class="card-top text-center">
                                <h3> Informations Financières </h3>
                            </div>
                            <div class="card-content">
                                @if($financialInformation->noTps)
                                    <p>No TPS : 
                                        <span>{{$financialInformation->noTps}}</span>
                                    </p>
                                    <p>No TVQ : 
                                        <span>{{$financialInformation->noTvq}}</span>
                                    </p>
                                    <p>Condition de paiement : 
                                        <span>{{$financialInformation->conditionPaiement}}</span>
                                    </p>
                                    <p>Devise : 
                                        <span>{{$financialInformation->devise}}</span>
                                    </p>
                                    <p>Mode de communication : 
                                        <span>{{$financialInformation->modeCommunication}}</span>
                                    </p>
                                @else
                                    <p class="text-danger">
                                        <i class="fas fa-times-circle"></i> Aucune informations financières fournies
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-1"></div>

                <div class="col-1"></div>
                <div class="col-10">

                    <div class="card-container">
                        <div class="persoCard">
                            <div class="card-top text-center">
                                <h3> Statut </h3>
                            </div>
                            <div class="card-content">
                            <p class="card-text 
                        @if ($fournisseur_actuel->statut == 'A') text-success
                        @elseif ($fournisseur_actuel->statut == 'AT') text-warning
                        @elseif ($fournisseur_actuel->statut == 'AR') text-primary
                        @elseif ($fournisseur_actuel->statut == 'R') text-danger
                        @elseif ($fournisseur_actuel->statut == 'D') text-muted
                        @endif">
                        
                        @if ($fournisseur_actuel->statut == 'A')
                            <i class="fas fa-check-circle"></i> Acceptée
                        @elseif ($fournisseur_actuel->statut == 'AT')
                            <i class="fas fa-hourglass-half"></i> En attente
                        @elseif ($fournisseur_actuel->statut == 'AR')
                            <i class="fas fa-exclamation-circle"></i> À réviser
                        @elseif ($fournisseur_actuel->statut == 'R')
                            <i class="fas fa-times-circle"></i> Refusée
                        @elseif ($fournisseur_actuel->statut == 'D')
                            <i class="fas fa-ban"></i> Désactivée
                        @else
                            <i class="fas fa-info-circle"></i> Statut inconnu
                        @endif
                    </p>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-1"></div>
            </div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">

                    <div class="card-container">
                        <div class="persoCard">
                            <div class="card-top text-center">
                                <h3> Licence RBQ </h3>
                            </div>
                            <div class="card-content">
                                @if($fournisseur_actuel->rbq)
                                    <p>Numéro : 
                                        <span>{{$fournisseur_actuel->rbq}}</span>
                                    </p>
                                    <p class="text-success">
                                        <i class="fas fa-check-circle"></i> Valide
                                    </p>
                                @else
                                    <p>Numéro : <span class="text-muted">Non renseigné</span></p>
                                    <p class="text-danger">
                                        <i class="fas fa-times-circle"></i> Invalide ou non fourni
                                    </p>
                                @endif
                                <p>Catégories :</p>
                                <ul>
                                    @foreach($licencesRbq as $licenceRbq)
                                        <li>{{ $licenceRbq }}</li><hr>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-1"></div>
            </div>
        </div>

       

    </div>

</div>

<div class="col-6">

<div class="row">
        <div class="col-6">
            <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

            <div class="card-container">
                <div class="persoCard">
                <div class="card-top text-center">
                <h3> Documents </h3>
                </div>
                <div class="card-content">

                <p> Fichier: <br> {{$fichier}} </p><hr>
                

                </div>
                    <div class="card-bot text-center align-self-center"     <?php if( $fichier != "Aucun Fichier Envoyé") { ?> style="height: 100px; !important"                         <?php } ?>>
                        <div class="col-12">
                            <form action="{{route('Fournisseurs.fichier.upload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="row align-self-center">
                                    <div class="form-group col-6">
                                        <input type="file" accept=" .pdf, .png, .txt, .docx " class="form-control-file" id="file" name="file[]" style="color:white;" multiple>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn" style="background-color: #FFFFFF; border-color: black; color:black;">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if( $fichier != "Aucun Fichier Envoyé") { ?>
                            <div class="col-12 align-self-center">
                                <a href="{{route('Fournisseurs.fichier.delete')}}" class="btn align-self-center"> Supprimer le fichier </a>     
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-1"></div>
            </div>
        </div>
        @for ($i = 0; $i < (count($PersonnesContact)/6); $i++)
            <div class="col-6">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">


                        <div class="card-container">
                            <div class="persoCard">
                                <div class="card-top text-center">
                                    <h3> Personne Contact {{$i+1}} </h3>
                                </div>
                                <div class="card-content">

                                    <p> Contact {{$i+1}} : <br> {{$PersonnesContact[$i *6]}} </p><hr>

                                    <p> {{$PersonnesContact[($i *6)+1] }} : <br>   {{$PersonnesContact[($i *6)+2] }} </p><hr>

                                    <p> {{$PersonnesContact[($i *6)+3] }} : <br>   {{$PersonnesContact[($i *6)+4] }} </p><hr>

                                    <p> Courriel:   <br> {{$PersonnesContact[($i *6)+5]}} </p><hr>


                                </div>
                            </div>
                        </div>

                    </div>
                <div class="col-1"></div>
                </div>
            </div>
        @endfor

    </div>

</div>

<div class="col-12">
    <div class="text-center">
    <a href="{{route('Fournisseurs.edit')}}" class="btn align-self-center" style="background-color: #FFFFFF; border-color: black; color:black;"> Modifier les informations </a>
    @if($fournisseur_actuel->statut == 'A')
    <a href="{{route('Fournisseurs.editFinancialInformation')}}" class="btn align-self-center" style="background-color: #FFFFFF; border-color: black; color:black;"> Modifier ou ajouter les informations financières </a>
    @endif
</div>
</div>
</div>

@endsection