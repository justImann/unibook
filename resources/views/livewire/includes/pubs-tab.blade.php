<x-card>
    <x-header title="Tab kelola penerbit" size="text-xl" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" label="Tambah penerbit" class="btn-primary"
                @click="$wire.drawerPublisher = true" />
        </x-slot:actions>
    </x-header>
    <div>
        <x-table :headers="$pubHeaders" :rows="$publishers" :sort-by="$sortBy">
            @scope('cell_stocks', $publisher)
                {{ $publisher->books->count() }}
            @endscope
            @scope('actions', $publisher)
                <div class="flex gap-1">
                    <x-button icon="o-pencil" wire:click="editPub({{ $publisher['id'] }})" spinner
                        class="btn-ghost btn-sm text-cyan-500" />
                    <x-button icon="o-trash" wire:click="deletePub({{ $publisher->id }})" spinner
                        class="btn-ghost btn-sm text-red-500" />
                </div>
            @endscope
        </x-table>
    </div>
</x-card>