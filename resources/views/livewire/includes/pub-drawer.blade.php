<!-- DRAWER CREATE PENERBIT -->
<x-drawer wire:model="drawerPublisher" title="Tambah Penerbit" right separator with-close-button class="lg:w-1/3">
    <x-form wire:submit="savePub">
        {{-- Full error bag --}}
        {{-- All attributes are optional, remove it and give a try --}}
        <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />
        <x-input label="Nama penerbit" wire:model="publisherName" />
        <div class="grid md:grid-cols-2 gap-2">
            <x-input label="Alamat" wire:model="address" />
            <x-input label="Kota" wire:model="city" />
        </div>
        <x-input label="No Handphone" wire:model="phone_number" />
        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Save!" class="btn-primary" type="submit" spinner />
        </x-slot:actions>
    </x-form>
</x-drawer>
