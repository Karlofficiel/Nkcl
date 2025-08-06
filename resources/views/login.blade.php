<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <h1 class="main-title">Nkcl Tasks</h1>

    <div class="login-box">
        <h2>Connexion</h2>

        {{-- Affichage des messages de succès --}}
        @if (session('success'))
            <div style="color: green; text-align: center; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Affichage des messages d’erreur --}}
        @if (session('error'))
            <div style="color: red; text-align: center; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Affichage des erreurs de validation --}}
        @if ($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                <ul style="list-style: none; padding: 0; text-align: center;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="/login">
            @csrf
            <input type="email" placeholder="Adresse Email" name="email" required>
            <input type="password" placeholder="Mot de passe" name="password" required>
            <button type="submit">Se connecter</button>
        </form>

        <div class="redirect-link">
            Vous n'avez pas de compte ? <a href="\">S'inscrire</a>
        </div>
    </div>
</body>
</html>
