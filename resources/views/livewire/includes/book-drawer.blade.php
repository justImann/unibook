<x-drawer wire:model="drawerBook" title="Tambah Buku" right separator with-close-button class="lg:w-1/3">
    <x-form wire:submit="saveBook">
        {{-- Full error bag --}}
        {{-- All attributes are optional, remove it and give a try --}}
        <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />

        <x-input label="Nama buku" wire:model="bookName" />
        <div class="grid md:grid-cols-2 gap-2">
            <x-input type="number" label="Harga buku" wire:model="price" />
            <x-input type="number" label="Stok buku" wire:model="stocks" />
        </div>
        <select wire:model="category" class="select select-bordered w-full border-primary">
            <option disabled selected>Pilih Kategori</option>
            <option value="Keilmuan">Keilmuan</option>
            <option value="Bisnis">Bisnis</option>
            <option value="Novel">Novel</option>
            <option value="Sejarah">Sejarah</option>
        </select>
        <select wire:model="publisher_id" class="select select-bordered w-full border-primary">
            <option disabled selected>Pilih Penerbit</option>
            @foreach ($value_publishers as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Save!" class="btn-primary" type="submit" spinner />
        </x-slot:actions>
    </x-form>

</x-drawer>