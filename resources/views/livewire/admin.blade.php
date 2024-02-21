@php
    $value_publishers = App\Models\Publisher::all();
@endphp

<div>
    <!-- HEADER -->
    <x-header title="Halaman Admin" >
        <x-slot:actions>
            <x-theme-toggle class="btn" />
        </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-tabs selected="books-tab">
            <x-tab name="books-tab" label="Kelola Buku" icon="o-clipboard-document-list">
                @include('livewire.includes.books-tab')
            </x-tab>
            <x-tab name="publisher-tab" label="Kelola Penerbit" icon="o-pencil-square">
                @include('livewire.includes.pubs-tab')
            </x-tab>
        </x-tabs>
    </x-card>

    <!-- INCLUDES BUKU -->
    @include('livewire.includes.book-drawer')
    @include('livewire.includes.book-modal')
    <!-- INCLUDES PENERBIT -->
    @include('livewire.includes.pub-drawer')
    @include('livewire.includes.pub-modal')
</div>
