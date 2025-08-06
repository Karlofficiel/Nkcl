@include('dashboard')
<title>Formtache</title>
<link rel="stylesheet" href="{{ asset('css/formtache.css') }}">
<main style="position:absolute; left:300px; top:120px;">
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('taches.store') }}">
            @csrf

            <label for="tache">Nom de la tâche</label>
            <input type="text" id="tache" name="nomtache" placeholder="Nom de la tâche" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Détaillez ce que vous proposez..." required></textarea>

            <label for="nomemployer">Nom de l'Employer</label>
            <input type="text" id="nomemployer" name="nomemployer" placeholder="Nom de l'employer" required>

            <label for="datedebut">Date Début</label>
            <input type="date" id="datedebut" name="date_debut" required>

            <label for="datefin">Date Fin</label>
            <input type="date" id="datefin" name="date_fin" required>

            <button type="submit">Assigner la Tâche</button>
        </form>
    </div>
</main>
