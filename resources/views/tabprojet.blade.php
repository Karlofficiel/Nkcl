@include('dashboard')
<title>TabProjet</title>
@vite(['resources/css/tabprojet.css'])
<main style="position:absolute; left:300px; top:120px;">
  <h1>Mes Projets</h1>

  <!-- 🔍 Formulaire de recherche -->
  <form action="{{ route('projets.search') }}" method="GET" class="search-form" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center; ">
    <input type="text" name="search" placeholder="Rechercher un projet..." value="{{ request('search') }}" style="padding: 6px 10px;color: black; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1;background-color:white;">
    <button type="submit">Rechercher</button>
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
          <th>Nom projet</th>
          <th>Description</th>
          <th>Employé 1</th>
          <th>Employé 2</th>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($projets as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nameprojet }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->nameemployer1 }}</td>
            <td>{{ $item->nameemployer2 }}</td>
            <td>{{ $item->date_debut }}</td>
            <td>{{ $item->date_fin }}</td>
            <td>
              <form method="POST" action="{{ route('projets.destroy', $item->id) }}" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <input type="submit" value="Supprimer" class="delete-btn">
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" style="text-align: center;">Aucun projet trouvé.</td>
          </tr>
        @endforelse 
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="custom-pagination">
    @if ($projets->onFirstPage())
        <span class="disabled">← Précédent</span>
    @else
        <a href="{{ $projets->previousPageUrl() }}" class="btn">← Précédent</a>
    @endif

    @if ($projets->hasMorePages())
        <a href="{{ $projets->nextPageUrl() }}" class="btn">Suivant →</a>
    @else
        <span class="disabled">Suivant →</span>
    @endif
  </div>
</main>
