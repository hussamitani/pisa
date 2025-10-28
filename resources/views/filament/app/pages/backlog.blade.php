<x-filament-panels::page>
    <div class="space-y-8">
        {{-- Sprint Tables --}}
        @foreach($this->getSprints() as $sprint)
            <div class="fi-section fi-section-page" wire:key="sprint-{{ $sprint->id }}">
                <div class="fi-section-header">
                    <div class="fi-section-header-heading">
                        <h3 class="fi-section-title text-xl font-semibold text-gray-950 dark:text-white">
                            {{ $sprint->name }}
                        </h3>
                        <p class="fi-section-description text-sm text-gray-500 dark:text-gray-400">
                            {{ $sprint->begins_at->format('d.m.Y') }} - {{ $sprint->ends_at->format('d.m.Y') }}
                            @if($sprint->description)
                                • {{ $sprint->description }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="fi-section-content">
                    <livewire:sprint-tickets-table :sprint="$sprint" :key="'sprint-table-' . $sprint->id" />
                </div>
            </div>
        @endforeach

        {{-- Backlog (Unassigned tickets) --}}
        <div class="fi-section fi-section-page">
            <div class="fi-section-header">
                <div class="fi-section-header-heading">
                    <h3 class="fi-section-title text-xl font-semibold text-gray-950 dark:text-white">
                        Backlog (Unassigned)
                    </h3>
                    <p class="fi-section-description text-sm text-gray-500 dark:text-gray-400">
                        Tickets not assigned to any sprint
                    </p>
                </div>
            </div>
            <div class="fi-section-content">
                {{ $this->table }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('sprint-updated', () => {
                @this.call('$refresh');
            });
        });
    </script>
</x-filament-panels::page>
