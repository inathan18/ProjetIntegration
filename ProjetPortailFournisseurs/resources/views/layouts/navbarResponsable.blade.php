<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
    <div class="container-fluid">
        <!-- Logo ou Titre -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logoFond.svg') }}" alt="Logo" width="60" height="60">
        </a>

        <!-- Bouton pour mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <!-- Bouton Liste des Fournisseurs -->
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('fournisseurs.recherche') }}">
                        <i class="fas fa-list-ul me-2"></i>
                        Liste des fournisseurs
                    </a>
                </li>

                <!-- Séparateur entre les éléments -->
                <li class="nav-item">
                    <span class="navbar-text mx-2">|</span>
                </li>

                <!-- Bouton Logout -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link d-flex align-items-center" style="display: inline; padding: 0; margin: 0; border: none;">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
