@extends("layouts.app")

@section('titre', 'Admin')

@section('contenu')
    <style>
        /* Styles de la sidebar */
        .sidebar {
            height: 100%;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
           /* Utilisation de la variable --bs-black */
            padding-top: 20px;
            overflow-y: auto;
            transition: width 0.3s; /* Animation de transition */
            z-index: 1000;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Bordure avec transparence */
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex; /* Affichage en flexbox pour aligner l'icône et le texte */
            align-items: center; /* Alignement vertical au centre */
            transition: background-color 0.3s; /* Animation de transition */
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        /* Style pour les icônes */
        .sidebar ul li a .bi {
            margin-right: 10px; /* Marge à droite de l'icône */
        }

        /* Styles pour le contenu */
        .content {
            margin-left: 220px; /* Marge pour la sidebar */
            padding: 20px;
            transition: margin-left 0.3s; /* Animation de transition */
        }

        /* Style pour le lien actif */
        .sidebar ul li.active a {
            background-color: #555;
        }

        /* Style pour le logo ou le titre */
        .sidebar-header {
            padding: 20px 10px;
            text-align: center;
        }

        .sidebar-header h3 {
            margin-bottom: 0;
            color: #fff;
        }

        /* Style pour le bouton de basculement de la sidebar */
        .sidebar-toggle {
            color: white;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            z-index: 1100;
        }

        .sidebar-toggle .bi {
            font-size: 1.5rem;
        }
    </style>

    <!-- Sidebar -->
    <div class="sidebar bg-dark">
        <div class="sidebar-header">
            <h3>Admin</h3>
        </div>
        <ul>
            <li><a href="{{ route('Admins.Panel') }}"><i class="bi bi-house-door"></i> Accueil</a></li>
            <li><a href="{{ route('Admins.Usagers') }}"><i class="bi bi-people"></i> Utilisateurs</a></li>
            <li><a href="{{ route('Admins.Parametres') }}"><i class="bi bi-gear-fill"></i> Paramètres</a></li>
            <li><a href="{{ route('NotificationTemplate.showForm') }}"><i class="bi bi-envelope"></i> Modèles Courriel</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        @yield('content')
    </div>

@endsection

@section('scripts')
    @yield('scripts')
@endsection
