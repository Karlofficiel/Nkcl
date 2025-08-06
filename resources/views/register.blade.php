<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
   
</head>
<body>
    <h1 class="main-title">Nkcl Tasks</h1>
  @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif
  <div class="login-box">
    <h2>Inscription</h2>
    <form method="post" action="/store">
      @csrf
      <input type="text"  name="name" placeholder="Nom d'utilisateur" required>
      <input type="email" name="email" placeholder="Adresse Email" required>
      <input type="password" name="password" placeholder="Mot de passe" required>

      <button type="submit">S'inscrire</button>
    </form>

    <div class="redirect-link">
      Vous avez déjà un compte ? <a href="\login">Se connecter</a>
    </div>
  </div>

</body>
</html>