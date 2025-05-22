<div>


    <h2 class="text-2xl font-bold mb-4">
        Fotos do imóvel: {{ $record->titulo }}
    </h2>

    <p class="mb-2">Proprietário: {{ $record->proprietario?->nome ?? 'Sem proprietário' }}</p>
    <p class="mb-2">Corretor: {{ $record->corretor?->nome ?? 'Sem corretor' }}</p>
    <p class="mb-2">Inquilino: {{ $record->inquilino?->nome ?? 'Sem inquilino' }}</p>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($record->fotos as $foto)
            <img
                src="{{ Storage::disk('public')->url($foto->caminho) }}"
                alt="Foto"
                class="rounded shadow w-full h-48 object-cover"
            >
        @endforeach
    </div>
</div>
