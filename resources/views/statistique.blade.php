 @include('dashboard')
 <title>Profil Page</title>
 <link rel="stylesheet" href="{{ asset('css/statistique.css') }}">
 <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<main style="position:absolute;left:300px;top:120px;">
<div class="welcome-message">
  Bonjour {{ Auth::user()->name }}, Bienvenue sur votre page Admin.
</div>
 <div class="card-container">
  <div class="summary-card green">
    <h3>Nombre de Tâches Total</h3>
    <p>12 Tâches effectuées</p>
    <div class="card-footer"></div>
  </div>

  <div class="summary-card orange">
    <h3>Nombre d'employers</h3>
    <p>10 Employers</p>
    <div class="card-footer"></div>
  </div>

  <div class="summary-card blue">
    <h3>Nombre de Tâche en Retard</h3>
    <p>3 Tâches en retard</p>
    <div class="card-footer"></div>
  </div>
</div>

<!-- Barre de recherche -->
<form method="GET" action="{{ route('statistique.utilisateurs') }}" class="form-search">
  <input
    type="text"
    name="search"
    placeholder="Rechercher un utilisateur..."
    value="{{ request('search') }}"
  >
  <button type="submit">Rechercher</button>
</form>

<div style="position:absolute;left:45px;top:260px;">
<div class="container">
@if ($utilisateurs->isEmpty())
  <div style="color: red; font-weight: bold; text-align: center; margin-top: 15px;">
    Aucun résultat trouvé.
  </div>
@endif
  <table>
    <thead>
      <tr class="btn-new">
        <th>Id</th>
        <th>Nom de l'Employé</th>
        <th>E-mail</th>
        <th>Statut</th>
        <th>Supprimer</th>
        <th>Bloquer</th>
        <th>Débloquer</th>
      </tr>
    </thead>
    <tbody>
@foreach($utilisateurs as $user)
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      <span style="
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-weight: bold;
        color: {{ $user->est_bloque ? '#a94442' : '#3c763d' }};
        background-color: {{ $user->est_bloque ? '#f2dede' : '#dff0d8' }};
      ">
        {{ $user->est_bloque ? 'Bloqué' : 'Actif' }}
      </span>
    </td>

    <td>
      <a href="{{ route('statistique.utilisateur.supprimer', $user->id) }}"
         style="
           background-color: #d9534f;
           color: white;
           padding: 6px ;
           text-decoration: none;
           border-radius: 5px;
           font-weight: 600;
           transition: background-color 0.3s ease;
         "
         onmouseover="this.style.backgroundColor='#c9302c'"
         onmouseout="this.style.backgroundColor='#d9534f'">
         Supprimer
      </a>
    </td>
    
    <td>
      <a href="{{ route('statistique.utilisateur.bloquer', $user->id) }}"
         style="
           background-color: #d9534f;
           color: white;
           padding: 6px ;
           text-decoration: none;
           border-radius: 5px;
           font-weight: 600;
           transition: background-color 0.3s ease;
         "
         onmouseover="this.style.backgroundColor='#c9302c'"
         onmouseout="this.style.backgroundColor='#d9534f'">
         Bloquer
      </a>
    </td>

    <td>
      <a href="{{ route('statistique.utilisateur.debloquer', $user->id) }}"
         style="
           background-color: #5cb85c;
           color: white;
           padding: 6px;
           text-decoration: none;
           border-radius: 5px;
           font-weight: 600;
           transition: background-color 0.3s ease;
         "
         onmouseover="this.style.backgroundColor='#449d44'"
         onmouseout="this.style.backgroundColor='#5cb85c'">
         Débloquer
      </a>
    </td>
  </tr>
@endforeach
    </tbody>
  </table>
  
</div>
<div class="custom-pagination" style="text-align:center; margin-top: 20px;">
    @if ($utilisateurs->onFirstPage())
        <span class="disabled" style="color: #aaa; padding: 8px 16px; font-weight: bold;">← Précédent</span>
    @else
        <a href="{{ $utilisateurs->previousPageUrl() }}" class="btn" style="
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            font-weight: bold;
        "
        onmouseover="this.style.backgroundColor='#0056b3'"
        onmouseout="this.style.backgroundColor='#007bff'">← Précédent</a>
    @endif

    @if ($utilisateurs->hasMorePages())
        <a href="{{ $utilisateurs->nextPageUrl() }}" class="btn" style="
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "
        onmouseover="this.style.backgroundColor='#0056b3'"
        onmouseout="this.style.backgroundColor='#007bff'">Suivant →</a>
    @else
        <span class="disabled" style="color: #aaa; padding: 8px 16px; font-weight: bold;">Suivant →</span>
    @endif
</div>
</div>
</main>