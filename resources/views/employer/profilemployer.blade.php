@include('employer.dashboardemployer')
<title>Profil Page</title>
@vite(['resources/css/profile.css'])
<main style="position:absolute;left:300px;top:120px;">

  @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
  @endif
  @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
  @endif

  <div class="container">
    <div class="card">
      <h2>Informations du profil</h2>
      <p>Mettez à jour les informations de profil et l’adresse e-mail de votre compte.</p>

      <form action="{{ route('employer.profil.update') }}" method="POST">
        @csrf
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="name" value="{{ old('name', $user->name) }}">

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">

        <button type="submit">ENREGISTRER</button>
      </form>
    </div>
  </div>

  <div class="profile-card">
    <h2>Mettre à jour le mot de passe</h2>
    <p>Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.</p>

    <form action="{{ route('employer.profil.password') }}" method="POST">
      @csrf
      <label for="current_password">Mot de passe actuel</label>
      <input type="password" id="current_password" name="current_password">

      <label for="new_password">Nouveau mot de passe</label>
      <input type="password" id="new_password" name="new_password">

      <label for="new_password_confirmation">Confirmer le mot de passe</label>
      <input type="password" id="new_password_confirmation" name="new_password_confirmation">

      <button type="submit">ENREGISTRER</button>
    </form>
  </div>

  <div class="profile-card delete-section">
    <h2>Supprimer le compte</h2>
    <p>Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>

    <form action="{{ route('employer.profil.delete') }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">SUPPRIMER LE COMPTE</button>
    </form>
  </div>

</main>
