<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    @vite(['resources/css/dashboard.css'])
</head>
<body>
    <div class="sidebar">
    <div class="top">
      <div class="logo">NKCL TASKS</div>
      <nav>
        <a href="/statistique">
          <svg class="icon" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/></svg>
          Statistique
        </a>
        <a href="/formtache">
          <svg class="icon" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6zm0 5h12v2H3v-2zm0 5h18v2H3v-2z"/></svg>
          Créer une tâche
        </a>
        <a href="/tabtache">
          <svg class="icon" viewBox="0 0 24 24"><path d="M21 6h-2v9H5v2h14v3l4-4-4-4v3z"/></svg>
          Consulter mes Tâches
        </a>
        <a href="/formprojet">
          <svg class="icon" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.84L19.53 19H4.47L12 5.84zM11 10v4h2v-4h-2zm0 6v2h2v-2h-2z"/></svg>
          Créer un projet
        </a>
        <a href="/projets">
          <svg class="icon" viewBox="0 0 24 24"><path d="M3 13h2v-2H3v2zm4 0h2v-2H7v2zm4 0h2v-2h-2v2zm4 0h2v-2h-2v2zm4 0h2v-2h-2v2z"/></svg>
          Consulter mes Projets
        </a>
        <a href="/formannonce">
          <svg class="icon" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.84L19.53 19H4.47L12 5.84zM11 10v4h2v-4h-2zm0 6v2h2v-2h-2z"/></svg>
          Créer une annonce
        </a>
        <a href="/mesannonces ">
          <svg class="icon" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8v-10h-8v10zm0-18v6h8V3h-8z"/></svg>
          Consulter mes annonces
        </a>
        <a href="/messages">
          <svg class="icon" viewBox="0 0 24 24"><path d="M20 2H4C2.9 2 2 .9 2 2v20l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
          Messagerie
        </a>
        <a href="/profil">
            <svg class="icon" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
            Profil
        </a>
        <!-- <a href="/tachesemployer">
           <svg class="icon" viewBox="0 0 24 24">
                    <path d="M9 11H7v2h2v-2zm8 0h-6v2h6v-2zm-8 4H7v2h2v-2zm8 0h-6v2h6v-2zM9 7H7v2h2V7zm10 0h-8v2h8V7z"/>
                 </svg>
                    Taches Employées
        </a> -->
        <a href="/deconnexion">
          <svg class="icon" viewBox="0 0 24 24"><path d="M16 13v-2H7V8l-5 4 5 4v-3h9zm3-10H5c-1.1 0-2 .9-2 2v6h2V5h14v14H5v-6H3v6c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
          Déconnexion
        </a>
      </nav>
    </div>
    <div class="footer">
      © 2025 NKCL TASKS. Tous droits réservés.
    </div>
  </div>

  <!-- Main content -->
  <div class="main">

    <!-- Header -->
    <div class="header">
      <h1>Tableau de bord</h1>
       @auth
        <div class="profile-name">{{ Auth::user()->name }}</div>
       @endauth
    </div>

    <!-- Main section -->
    <div class="content">
      
    </div>

    <!-- Footer -->
    <div class="main-footer">
      Copyright © 2025 NKCL TASKS — Created by Karl Officiel | Version 1.0.0
    </div>

  </div>
</body>
</html>