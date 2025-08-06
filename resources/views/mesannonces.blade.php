@include('dashboard')
<title>Form Annonces</title>
<link rel="stylesheet" href="{{ asset('css/mesannonces.css') }}">
<main style="position:absolute; left:300px; top:120px;">
    <h1>Consulter mes Annonces</h1>

    @if(session('success'))
        <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
    @endif

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
        @foreach($annonces as $annonce)
            <div style="width: 300px; background-color: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                
                <!-- Image -->
                @if($annonce->image)
                    <img src="{{ asset('storage/' . $annonce->image) }}" 
                         alt="Image Annonce" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
                @else
                    <div style="width: 100%; height: 200px; background-color: #eee; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #888;">
                        Aucune image
                    </div>
                @endif

                <!-- Description -->
                <p style="margin-top: 15px; font-size: 16px; color: #333;">
                    {{ $annonce->description }}
                </p>

                <!-- Formulaire de suppression -->
                <form action="{{ route('annonce.delete', $annonce->id) }}" method="POST" style="margin-top: 15px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')" 
                            style="width: 100%; padding: 10px; background-color: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Supprimer
                    </button>
                </form>

            </div>
        @endforeach
    </div>

    <!-- Pagination -->
@if ($annonces->hasPages())
    <div class="pagination" style="margin-top: 30px;">
        {{-- Précédent --}}
        @if ($annonces->onFirstPage())
            <span class="disabled">Précédent</span>
        @else
            <a href="{{ $annonces->previousPageUrl() }}">Précédent</a>
        @endif

        {{-- Suivant --}}
        @if ($annonces->hasMorePages())
            <a href="{{ $annonces->nextPageUrl() }}">Suivant</a>
        @else
            <span class="disabled">Suivant</span>
        @endif
    </div>
@endif
    
</main>
