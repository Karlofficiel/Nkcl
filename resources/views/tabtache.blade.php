@include('dashboard')
<link rel="stylesheet" href="{{ asset('css/tabtache.css') }}">
<title>TabTache</title>
<main style="position:absolute; left:300px; top:120px;">
  <h1>Mes Tâches</h1>

  <!-- Formulaire de recherche -->
  <form method="GET" action="{{ route('taches.search') }}" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center; ">
    <input 
      type="text" 
      name="search" 
      placeholder="Rechercher par nom de tâche..." 
      value="{{ request('search') }}"
      style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1;background-color:white;color: black;">
    <button type="submit" style="background-color: #007bff; color: white; padding: 6px 16px; border: none; border-radius: 4px; cursor: pointer;">
      Rechercher
    </button>
  </form>
  @if(session('success'))
    <div class="alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="container">
    <table>
      <thead>
        <tr class="btn-new">
          <th>ID</th>
          <th>Nom de la tâche</th>
          <th>Description</th>
          <th>Employé assigné</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($taches as $tache)
          <tr>
            <td>{{ $tache->id }}</td>
            <td>{{ $tache->nomtache }}</td>
            <td>{{ $tache->description }}</td>
            <td>{{ $tache->nomemployer }}</td>
            <td>{{ $tache->date_debut }}</td>
            <td>{{ $tache->date_fin }}</td>
            <td>
              <!-- Supprimer (à compléter avec une vraie route plus tard) -->
              <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Supprimer</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align: center;">Aucune tâche trouvée.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
@if ($taches->hasPages())
  <div class="pagination">
    {{-- Previous --}}
    @if ($taches->onFirstPage())
      <span class="disabled">Précédent</span>
    @else
      <a href="{{ $taches->previousPageUrl() }}">Précédent</a>
    @endif

    {{-- Next --}}
    @if ($taches->hasMorePages())
      <a href="{{ $taches->nextPageUrl() }}">Suivant</a>
    @else
      <span class="disabled">Suivant</span>
    @endif
  </div>
@endif

</main>
