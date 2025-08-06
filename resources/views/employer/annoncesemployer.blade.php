@include('employer.dashboardemployer')
<title>Annonces</title>
<main style="position:absolute;left:300px;top:120px;">
         <h1 style="font-size: 24px; margin-bottom: 20px;">Annonces de l'administrateur</h1>
    @if($annonces->isEmpty())
        <p style="color: #777;">Aucune annonce disponible.</p>
    @else
        @foreach($annonces as $annonce)
            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 20px; background-color: #f9f9f9; width: 400px;">
                {{-- Image --}}
                @if($annonce->image)
                    <img src="{{ asset('storage/' . $annonce->image) }}" 
                         alt="Image Annonce" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                @else
                    <div style="width: 100%; height: 200px; background-color: #eee; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #888; margin-bottom: 10px;">
                        Aucune image
                    </div>
                @endif

                {{-- Description --}}
                <p style="font-size: 16px; color: #333;">
                    {{ $annonce->description }}
                </p>
            </div>
        @endforeach
    @endif
</main