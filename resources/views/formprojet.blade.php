 @include('dashboard')
 <title>Formtache</title>
 <link rel="stylesheet" href="{{ asset('css/formprojet.css') }}">
<main style="position:absolute;left:300px;top:120px;">
    
     @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

 <div class="container"> 
    <form method="Post" action="{{ route('projet.store') }}">
        @csrf
        <label for="Nom de la tache">Nom du Projet</label>
        <input type="text" id="tache" name="nameprojet" placeholder="Nom du Projet" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" placeholder="Détaillez ce que vous proposez..." required></textarea>

        <label for="Nom Employer">Nom de l'Employer 1</label>
        <input type="text" id="nameemployer1" name="nameemployer1" placeholder="Nom de l'employer 1" required>

        <label for="Nom Employer">Nom de l'Employer 2</label>
        <input type="text" id="nameemployer2" name="nameemployer2" placeholder="Nom de l'employer 2" required>

        <label for="Date Début"> Date Début
        <input type="date" id="datedebut" name="date_debut" placeholder="Nom du produit ou service" required>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date Fin
        <input type="date" id="datefin" name="date_fin" placeholder="Nom du produit ou service" required>
        </label>
        
        <button type="submit">Assigner le Projet</button>
    </form>
 </div>
</main>