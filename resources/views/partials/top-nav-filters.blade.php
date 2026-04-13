@php
    $routeBase = $routeBase ?? '/';
    $brandTitle = $brandTitle ?? 'E-SKM PPM Bayan Group';
    $subtitle = $subtitle ?? null;
    $showBagian = $showBagian ?? false;
    $showHomeButton = $showHomeButton ?? false;
    $showAdminButton = $showAdminButton ?? true;
    $homeHref = $homeHref ?? '/';
    $adminHref = $adminHref ?? '/login';
    $selectedYear = $selectedYear ?? '';
    $selectedTw = $selectedTw ?? '';
    $bagianQuery = $bagianQuery ?? '';
    $selectedBagian = $selectedBagian ?? [];
    $bagianOptions = $bagianOptions ?? [];
    $selectedBagianNames = collect($selectedBagian)
        ->map(fn ($key) => $bagianOptions[$key] ?? null)
        ->filter()
        ->values();
    $bagianChipLabel = 'Pilar';
    $brandTitleClass = $brandTitleClass ?? 'text-base font-extrabold tracking-tight text-[#FF8800]';
    $extraButtons = $extraButtons ?? null;
    $enableLoadingNav = $enableLoadingNav ?? false;
    $loadingNavClass = $enableLoadingNav ? 'js-nav' : '';
    $navClass = $navClass ?? 'shrink-0 bg-white shadow-sm z-50 px-8 py-1.5';
    $containerClass = $containerClass ?? 'max-w-full px-16 mx-auto flex items-center justify-between';
    $filterWrapperClass = $filterWrapperClass ?? 'flex items-center gap-6';
@endphp

<nav class="{{ $navClass }} relative overflow-visible">
    <div class="{{ $containerClass }} overflow-visible">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/logo-bayan.png') }}" alt="Logo Bayan" class="h-8 w-8 rounded-xl bg-white p-1 border border-orange-200">
            <span class="{{ $brandTitleClass }}">{{ $brandTitle }}</span>
            <div class="h-6 w-px bg-slate-200 mx-4"></div>
            @if ($subtitle)
                <span class="text-[11px] font-black uppercase tracking-[0.14em] text-slate-400">{{ $subtitle }}</span>
            @endif
        </div>

        <div class="{{ $filterWrapperClass }} overflow-visible">

            <div class="filter-inline hidden">
                <span class="filter-inline-label">Tahun</span>
                <details class="filter-chip">
                    <summary>
                        <span class="material-symbols-outlined text-[#FF8800] text-[16px]">calendar_today</span>
                        <span class="filter-chip-value">{{ $selectedYear ?? 'Pilih Tahun' }}</span>
                        <span class="material-symbols-outlined filter-chip-caret">expand_more</span>
                    </summary>
                    <div class="filter-menu">
                        @foreach ([2024,2025,2026] as $yearOption)
                            <a class="{{ $loadingNavClass }} {{ $selectedYear == $yearOption ? 'is-active' : '' }}" href="{{ $routeBase }}?Tahun={{ $yearOption }}&bagian={{ $bagianQuery }}">{{ $yearOption }}</a>
                        @endforeach
                    </div>
                </details>
            </div>

            @if ($showBagian)
                <div class="filter-inline">
                            <span class="filter-inline-label">Pilar</span>
                    <details class="filter-chip min-w-[100px]">
                        <summary>
                            <span class="material-symbols-outlined text-[#FF8800] text-[16px]">tune</span>
                            <span class="filter-chip-value">{{ $bagianChipLabel }}</span>
                            <span class="material-symbols-outlined filter-chip-caret">expand_more</span>
                        </summary>
                        <div class="filter-menu bagian-menu">
                            <div class="max-h-64 overflow-auto space-y-2 pr-1">
                                @foreach ($bagianOptions as $value => $label)
                                    <label class="flex items-center gap-2 text-[12px] text-slate-700">
                                        <input type="checkbox" class="bagian-checkbox rounded border-slate-300" value="{{ $value }}" {{ in_array($value, $selectedBagian, true) ? 'checked' : '' }}>
                                        <span>{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <button type="button" id="applyBagian" class="mt-3 w-full bg-[#FF8800] text-white text-[11px] font-black py-2 rounded-lg hover:opacity-95 transition-opacity">Terapkan Filter</button>
                        </div>
                    </details>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3">
            @if ($showHomeButton)
                <a href="{{ $homeHref }}" class="admin-button whitespace-nowrap {{ $loadingNavClass }}">Halaman Utama</a>
            @endif
            @if ($showAdminButton)
                <a href="{{ $adminHref }}" class="{{ $showHomeButton ? 'admin-button ' . $loadingNavClass : $loadingNavClass }}">
                    @if ($showHomeButton)
                        Admin
                    @else
                        <button class="admin-button active:scale-95 {{ $loadingNavClass }}">Admin</button>
                    @endif
                </a>
            @endif
            @if ($extraButtons)
                {!! $extraButtons !!}
            @endif
        </div>
    </div>
</nav>



