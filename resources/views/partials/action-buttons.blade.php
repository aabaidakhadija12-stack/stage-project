@props([
    'show' => null,
    'edit' => null,
    'pdf' => null,
    'destroy' => null,
    'destroyMessage' => 'Supprimer cet élément ?',
])

<div class="action-group">
    @if($show)
    <a href="{{ $show }}" class="action-btn view" title="Voir les détails">
        <i class="bi bi-eye"></i>
    </a>
    @endif
    @if($edit)
    <a href="{{ $edit }}" class="action-btn edit" title="Modifier">
        <i class="bi bi-pencil-square"></i>
    </a>
    @endif
    @if($pdf)
    <a href="{{ $pdf }}" class="action-btn edit" title="Télécharger PDF" target="_blank">
        <i class="bi bi-file-earmark-pdf"></i>
    </a>
    @endif
    @if($destroy)
    <form method="POST" action="{{ $destroy }}" onsubmit="return confirm(@json($destroyMessage))">
        @csrf @method('DELETE')
        <button type="submit" class="action-btn delete" title="Supprimer">
            <i class="bi bi-trash3"></i>
        </button>
    </form>
    @endif
</div>
