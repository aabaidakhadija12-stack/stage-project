@props([
    'icon' => 'inbox',
    'message' => 'Aucun élément trouvé',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="bi bi-{{ $icon }}"></i></div>
            <p class="text-muted mb-2">{{ $message }}</p>
            @if($addUrl)
                <a href="{{ $addUrl }}" class="btn-add">
                    <i class="bi bi-plus-lg"></i> {{ $addLabel }}
                </a>
            @endif
        </div>
    </td>
</tr>
