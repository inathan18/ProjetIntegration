@extends('Admins.Panel')

@section('content')

<div class="content container m-0">
        <h2 class="mb-4 text-center">Créer un utilisateur</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-9">
                <form id="contactForm" method="post" action="{{ route('Admin.Usager.Store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="name@example.com" name="email"/>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select name="role" id="role" class="form-select">
                            <option value="administrateur">Administrateur</option>
                            <option value="commis">Commis</option>
                            <option value="responsable">Responsable</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
