@include('dashboard')
<title>Messagerie</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
<main class="messagerie-wrapper">
  <div class="messagerie-container">

    <!-- Liste des contacts -->
    <div class="messagerie-sidebar">
      <h3>Contacts</h3>
      <ul id="users-list" style="list-style:none; padding-left: 0;">
        @foreach($users as $user)
          <li class="messagerie-contact" data-id="{{ $user->id }}">
            <img src="https://i.pravatar.cc/40?u={{ $user->id }}" alt="">
            <div>
              <strong>{{ $user->name }}</strong>
              <p>Cliquer pour discuter</p>
            </div>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Zone de chat -->
    <div class="messagerie-chat">
      <div id="chat-header" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
        <h4>Sélectionnez un contact pour démarrer la discussion</h4>
      </div>

      <div class="messagerie-messages" id="messages" style="height: 400px; overflow-y: auto; margin: 10px 0; border: 1px solid #ccc; padding: 10px;">
        <!-- Les messages s’afficheront ici -->
      </div>

      <!-- Zone de saisie -->
      <form id="message-form" class="messagerie-input" style="display: flex;" onsubmit="return sendMessage(event);" enctype="multipart/form-data">
  
  {{-- Champ message --}}
  <input type="text" name="content" id="message-input" placeholder="Écrire un message..." style="flex: 1; padding: 10px;">
  
  {{-- Champ fichier joint --}}
  <input type="file" name="file" style="margin-left: 10px;">

  {{-- Bouton envoyer --}}
  <button type="submit" title="Envoyer" style="margin-left: 10px;">
    <img src="{{ asset('img/envoie.png') }}" alt="Send" style="width: 24px;">
  </button>

  {{-- Bouton supprimer tous les messages --}}
  <button type="button" title="Supprimer tout" onclick="deleteAllMessages()" style="margin-left: 10px;">
    <img src="{{ asset('img/supprimer.png') }}" alt="Delete All" style="width: 24px;">
  </button>
</form>
    </div>
  </div>
</main>

<script>
  let selectedUserId = null;

  document.querySelectorAll('.messagerie-contact').forEach(contact => {
    contact.addEventListener('click', () => {
      document.querySelectorAll('.messagerie-contact').forEach(c => c.classList.remove('active'));
      contact.classList.add('active');

      selectedUserId = contact.dataset.id;

      const userName = contact.querySelector('strong').textContent;
      document.getElementById('chat-header').innerHTML = `<h4>Discussion avec ${userName}</h4>`;

      document.getElementById('message-input').disabled = false;
      document.querySelector('#message-form button[type="submit"]').disabled = false;

      loadMessages(selectedUserId);
    });
  });

  function loadMessages(userId) {
    fetch(`/messages/${userId}`)
      .then(res => res.json())
      .then(messages => {
        const container = document.getElementById('messages');
        container.innerHTML = '';
        messages.forEach(m => {
          const isSender = m.sender_id == {{ Auth::id() }};
          const div = document.createElement('div');
          div.className = isSender ? 'message sent' : 'message received';
          div.innerHTML = `
            <p>
              <strong>${isSender ? 'Vous' : m.sender.name}</strong>: ${m.content}
              ${isSender ? `<button onclick="deleteMessage(${m.id})" style="margin-left: 10px; background: none; border: none; color: red; cursor: pointer;">🗑</button>` : ''}
            </p>
            <span class="time">${new Date(m.created_at).toLocaleString()}</span>
          `;
          container.appendChild(div);
        });
        container.scrollTop = container.scrollHeight;
      });
  }

function sendMessage(event) {
    event.preventDefault();

    let form = document.getElementById('message-form');
    let formData = new FormData(form);
    formData.append('receiver_id', selectedUserId); // à définir dynamiquement

    fetch('{{ route("messages.send") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Message envoyé', data);
        document.getElementById('message-input').value = '';
        form.querySelector('input[name="file"]').value = '';
        loadMessages(selectedUserId); // recharge les messages
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'envoi du message');
    });

    return false;
}


  function deleteMessage(id) {
    if (!confirm("Supprimer ce message ?")) return;

    fetch(`/messages/${id}/delete`, {
      method: 'DELETE',
      title: 'Supprimer le message',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        loadMessages(selectedUserId);
      }
    })
    .catch(err => alert('Erreur lors de la suppression.'));
  }

  function deleteAllMessages() {
    if (confirm("Supprimer tous les messages ?")) {
      document.getElementById('messages').innerHTML = '';
    }
  }
</script>
