<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Affiche la page messagerie avec la liste des utilisateurs
    public function index()
    {
        // Liste des utilisateurs sauf toi
        $users = Utilisateur::where('id', '!=', Auth::id())->get();

        return view('messages', compact('users'));
    }

    // Récupère les messages échangés avec un utilisateur donné (ajax)
    public function getMessages(Utilisateur $user)
    {
        $me = Auth::user();

        $messages = Message::where(function ($query) use ($me, $user) {
            $query->where('sender_id', $me->id)->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($me, $user) {
            $query->where('sender_id', $user->id)->where('receiver_id', $me->id);
        })->orderBy('created_at')->get();

        // Charger les relations sender pour afficher le nom
        $messages->load('sender');

        return response()->json($messages);
    }

    // Envoie un message à un utilisateur
    public function sendMessage(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:utilisateurs,id',
        'content' => 'nullable|string|max:1000',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('messages_files', 'public');
    }

    $message = Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'content' => $request->content,
        'file_path' => $filePath,
    ]);

    $message->load('sender');

    return response()->json($message);
}
    
public function destroy($id)
{
    $message = Message::findOrFail($id);

    // Autoriser uniquement l'auteur du message à le supprimer
    if ($message->sender_id != auth()->id()) {
        return response()->json(['error' => 'Non autorisé'], 403);
    }

    $message->delete();

    return response()->json(['success' => true]);
}
}
