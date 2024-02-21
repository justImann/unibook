<x-card>
    <x-header title="Tab kelola buku" size="text-xl" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" label="Tambah buku" class="btn-primary"
                @click="$wire.drawerBook = true" />
        </x-slot:actions>
    </x-header>
    <div>
        <x-table :headers="$bookHeaders" :rows="$books" :sort-by="$sortBy">
            @scope('cell_publisher', $book)
                {{ $book->publisher->name }}
            @endscope
            @scope('cell_price', $book)
                <b>Rp. </b>{{ $book->price }}
            @endscope
            @scope('actions', $book)
                <div class="flex gap-1">
                    <x-button icon="o-pencil" wire:click="editBook({{ $book['id'] }})" spinner
                        class="btn-ghost btn-sm text-cyan-500" />
                    <x-button icon="o-trash" wire:click="deleteBook({{ $book->id }})" spinner
                        class="btn-ghost btn-sm text-red-500" />
                </div>
            @endscope
        </x-table>
    </div>
</x-card>