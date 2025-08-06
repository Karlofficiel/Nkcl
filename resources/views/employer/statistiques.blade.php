@include('employer.dashboardemployer')
<title>Profil Page</title>
<link rel="stylesheet" href="{{ asset('css/statistique.css') }}">

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 14px 18px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #28a745;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .statut {
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 6px;
        display: inline-block;
        font-size: 14px;
    }

    .en-cours {
        background-color: #d4edda;
        color: #155724;
         cursor: pointer;
    }

    .en-attente {
        background-color: #fff3cd;
        color: #856404;
         cursor: pointer;
    }

    .terminee {
        background-color: #d6d8d9;
        color: #383d41;
         cursor: pointer;
    }
    .btn-supprimer {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 7px 12px;
        border-radius: 6px;
        cursor: pointer;
    }
    .btn-supprimer:hover {
        background-color: #c82333;
    }
    .pagination-buttons {
  margin-top: 20px;
  display: flex;
  gap: 15px;
  font-family: Arial, sans-serif;
}

.pagination-buttons a,
.pagination-buttons span {
  padding: 8px 16px;
  border-radius: 6px;
  border: 1px solid #28a745;
  color: #28a745;
  text-decoration: none;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination-buttons a:hover {
  background-color: #28a745;
  color: white;
}

.pagination-buttons span {
  color: #aaa;
  border-color: #aaa;
  cursor: default;
  background-color: #f8f9fa;
}

</style>

<main style="position:absolute;left:300px;top:120px;">
    <div class="welcome-message">
        Bonjour, Bienvenue sur votre page Employer.
    </div>

    <div class="card-container">
        <div class="summary-card green">
            <h3>Nombre de Tâches Total</h3>
            <p>{{ $totalTaches }} Tâches effectuées</p>
            <div class="card-footer"></div>
        </div>

        <div class="summary-card orange">
            <h3>Nombre de Tâche en cours</h3>
            <p>{{ $tachesEnCours }} Tâches en cours</p>
            <div class="card-footer"></div>
        </div>

        <div class="summary-card blue">
            <h3>Nombre de Tâche en Retard</h3>
            <p>{{ $tachesEnRetard }} Tâches en retard</p>
            <div class="card-footer"></div>
        </div>

    </div>

    <!-- Tableau des tâches -->
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom de la tâche</th>
                <th>Description</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach($taches as $tache)
    <tr>
        <td>{{ $tache->id }}</td>
        <td>{{ $tache->nomtache }}</td>
        <td>{{ $tache->description }}</td>
        <td>{{ $tache->date_debut }}</td>
        <td>{{ $tache->date_fin }}</td>
        <td>
            @if($tache->statut == 'En cours')
                <span class="statut en-cours">{{ $tache->statut }}</span>
            @elseif($tache->statut == 'En attente')
                <span class="statut en-attente">{{ $tache->statut }}</span>
            @elseif($tache->statut == 'Terminée')
                <span class="statut terminee">{{ $tache->statut }}</span>
            @endif
        </td>
        <td>
            <a href="{{ route('employer.taches.statut', ['id' => $tache->id, 'statut' => 'En cours']) }}">
                <span class="statut en-cours">En cours</span>
            </a>
            <a href="{{ route('employer.taches.statut', ['id' => $tache->id, 'statut' => 'En attente']) }}">
                <span class="statut en-attente">En attente</span>
            </a>
            <a href="{{ route('employer.taches.statut', ['id' => $tache->id, 'statut' => 'Terminée']) }}">
                <span class="statut terminee">Terminée</span>
            </a>
            <a href="{{ route('employer.taches.supprimer', ['id' => $tache->id]) }}">
                <button class="btn-supprimer">Supprimer</button>
            </a>
        </td>
    </tr>
@endforeach
           
        </tbody>
    </table>
   <div class="pagination-buttons">
    @if ($taches->onFirstPage())
        <span>Précédent</span>
    @else
        <a href="{{ $taches->previousPageUrl() }}">Précédent</a>
    @endif

    @if ($taches->hasMorePages())
        <a href="{{ $taches->nextPageUrl() }}">Suivant</a>
    @else
        <span>Suivant</span>
    @endif
</div>

</main>
