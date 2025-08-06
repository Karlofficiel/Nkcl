@include('dashboard')
<title>Form Annonces</title>
<link rel="stylesheet" href="{{ asset('css/formannonce.css') }}">
<main style="position:absolute; left:300px; top:120px;">
    <h1>Publier une Annonce</h1>
      @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container"> 
        <form method="POST" action="{{ route('annonces.store') }}" enctype="multipart/form-data">
            @csrf

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Détaillez votre annonce..." required></textarea>

            <label for="photo">Photo</label>
            <input type="file" id="tof" name="image">

            <button type="submit">Publier l'annonce</button>
        </form>
    </div>

    
</main>
