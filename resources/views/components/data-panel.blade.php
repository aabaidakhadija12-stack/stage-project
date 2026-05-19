@props([
    'accent' => 'orange',
    'icon' => 'grid',
    'title' => '',
    'description' => '',
    'stat' => '',
    'statIcon' => 'layers',
    'addUrl' => null,
    'addLabel' => 'Ajouter',
])

<div {{ $attributes->merge(['class' => 'data-panel accent-' . $accent . ' mb-4']) }}>
    <div class="data-panel-header">
        <div class="data-panel-meta">
            <div class="data-panel-icon"><i class="bi bi-{{ $icon }}"></i></div>
            <div>
                <h2 class="data-panel-title">{{ $title }}</h2>
                @if($description)
                    <p class="data-panel-desc">{{ $description }}</p>
                @endif
            </div>
            @if($stat)
                <span class="data-panel-stat">
                    <i class="bi bi-{{ $statIcon }}"></i>
                    {{ $stat }}
                </span>
            @endif
        </div>
        @if($addUrl)
            <a href="{{ $addUrl }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> {{ $addLabel }}
            </a>
        @endif
    </div>

    @isset($filters)
        <div class="filter-bar">{{ $filters }}</div>
    @endisset

    {{ $slot }}

    @isset($footer)
        <div class="card-footer py-3 px-3">{{ $footer }}</div>
    @endisset
</div>
