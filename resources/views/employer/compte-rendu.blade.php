@include('employer.dashboardemployer')
link rel="stylesheet" href="{{ asset('css/compte-rendu.css') }}">
<title>Annonces</title>
<main style="position:absolute;left:300px;top:120px;">
    <div class="container">
    <h1>Compte Rendu</h1>
    <p>Veuillez remplir le formulaire ci-dessous pour soumettre votre compte rendu.</p>

    
    @if(session('success'))
        <div style="color: green; font-weight: bold; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    
</div>
    <form action="{{ route('employer.compte-rendu.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 500px; margin: 20px;">
        @csrf

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required style="width: 100%; padding: 8px; margin-bottom: 10px;">

        <label for="fichier">Joindre un fichier :</label>
        <input type="file" id="fichier" name="fichier" required style="width: 100%; padding: 8px; margin-bottom: 15px;">

        <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            Envoyer
        </button>
    </form>
</main