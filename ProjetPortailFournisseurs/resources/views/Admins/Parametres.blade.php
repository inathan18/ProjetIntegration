@extends('Admins.Panel')

@section('content')
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Gestion des paramètres</h2>

        <form method="POST" action="{{ route('Admins.updateParameters') }}">
        @csrf
            <div class="mb-3 row">
                <label for="emailAppro" class="col-sm-4 col-form-label">Courriel de l'Appro.</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="emailAppro" name="emailAppro"value="{{$parameter->emailAppro}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="delaiRevision" class="col-sm-4 col-form-label">Délai avant la révision (mois)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="delaiRevision" name="delaiRevision" value="{{$parameter->delaiRevision}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tailleFichier" class="col-sm-4 col-form-label">Taille maximale des fichiers joints (Mo)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="tailleFichier" name="tailleFichier" value="{{$parameter->tailleFichier}}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="emailFinance" class="col-sm-4 col-form-label">Courriel des Finances</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="emailFinance" name="emailFinance" value="{{$parameter->emailFinance}}">
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
