@extends('Admins.Panel')

@section('content')
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Gestion des paramètres</h2>

        <form>
            <div class="mb-3 row">
                <label for="courrielAppro" class="col-sm-4 col-form-label">Courriel de l'Appro.</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="courrielAppro" value="approvisionnement@v3r.net">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="delaiRevision" class="col-sm-4 col-form-label">Délai avant la révision (mois)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="delaiRevision" value="24">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tailleFichiers" class="col-sm-4 col-form-label">Taille maximale des fichiers joints (Mo)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="tailleFichiers" value="75">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="courrielFinances" class="col-sm-4 col-form-label">Courriel des Finances</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="courrielFinances" value="finances@v3r.net">
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Confirmer les modifications</button>
                <button type="reset" class="btn btn-secondary">Annuler les modifications</button>
            </div>
        </form>
    </div>
</body>
@endsection
