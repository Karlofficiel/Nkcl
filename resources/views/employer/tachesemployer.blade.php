@include('employer.dashboardemployer')
<title>Cree une Tache</title>
<style>
    main {
        position: absolute;
        left: 300px;
        top: 120px;
    }

    .container {
        display: inline-block;
        padding: 20px 30px; /* plus d'espace interne */
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* agrandi légèrement */
        width: 100%;
        height: auto;
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
        font-size: 15px;
    }

    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 4px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    textarea {
        height: 80px;
        resize: vertical;
    }

    button[type="submit"] {
        margin-top: 16px;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }

    .date-fields {
        display: flex;
        gap: 20px;
        margin-top: 10px;
    }

    .date-fields label {
        flex: 1;
        font-size: 14px;
    }
</style>

<main>

@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif
    <h1>Créer une Tâche</h1><br>
    <div class="container">
        
        <form method="POST" action="{{ route('employer.taches.store') }}">
            @csrf

            <label for="tache">Nom de la tâche</label>
            <input type="text" id="tache" name="nomtache" placeholder="Nom de la tâche" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Détaillez ce que vous proposez..." required></textarea>

            <div class="date-fields">
                <label for="datedebut">Date Début
                    <input type="date" id="datedebut" name="date_debut" required>
                </label>

                <label for="datefin">Date Fin
                    <input type="date" id="datefin" name="date_fin" required>
                </label>
            </div>

            <button type="submit">Créer la Tâche</button>
        </form>
    </div>
</main>
