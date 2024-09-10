@extends('Admins.Panel')

@section('content')

<div class="container">
    <h2 class="mb-4">Modèles de courriels</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Courriel</h5>
                        <div class="mb-3">
                            <label for="objet" class="form-label">Objet</label>
                            <input type="text" id="objet" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" class="form-control" rows="6">
                            </textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success">Enregistrer les modifications</button>
                            <button class="btn btn-secondary">Annuler</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Modèles</h5>
                        <div class="mb-3">
                            <select id="modele" class="form-select">
                                <option>Accusé de réception</option>
                                <option>Approbation</option>
                                <option>Refus</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary">Ajouter</button>
                            <button class="btn btn-danger">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection