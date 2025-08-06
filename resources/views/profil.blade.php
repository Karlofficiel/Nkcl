@include('dashboard')
<title>Profil Page</title>
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<main style="position:absolute;left:300px;top:120px;">
  <div class="container">
    <div class="card">
      <h2>Informations du profil</h2>
      <p>Mettez à jour les informations de profil et l’adresse e-mail de votre compte.</p>

      @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
      @endif

      @if($errors->any())
        <ul style="color: red;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form action="{{ route('profil.update') }}" method="POST">
        @csrf
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="name" value="{{ auth()->user()->name }}">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}">

        <button type="submit">ENREGISTRER</button>
      </form>
    </div>
  </div>

  <div class="profile-card">
    <h2>Mettre à jour le mot de passe</h2>
    <p>Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.</p>

    <form action="{{ route('profil.password') }}" method="POST">
      @csrf
      <label for="current_password">Mot de passe actuel</label>
      <input type="password" id="current_password" name="current_password">

      <label for="new_password">Nouveau mot de passe</label>
      <input type="password" id="new_password" name="new_password">

      <label for="confirm_password">Confirmer le mot de passe</label>
      <input type="password" id="confirm_password" name="confirm_password">

      <button type="submit">ENREGISTRER</button>
    </form>
  </div>

  <div class="profile-card delete-section">
    <h2>Supprimer le compte</h2>
    <p>Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.</p>

    <form action="{{ route('profil.delete') }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="delete-btn">SUPPRIMER LE COMPTE</button>
    </form>
  </div>

  @if(session('no_results'))
    <p style="color: red;">{{ session('no_results') }}</p>
  @endif
</main>
