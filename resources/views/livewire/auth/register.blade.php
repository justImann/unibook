<div>
    <div class="grid place-content-center h-full w-full">
        <x-card class="w-96 md:mt-44">
            <x-form wire:submit="save">
                {{-- Full error bag --}}
                {{-- All attributes are optional, remove it and give a try--}}
                <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />
             
                <x-input label="Nama" wire:model="name" />
                <x-input label="Email" wire:model="email" />
             
                <x-input label="Password" wire:model="password" type="password" />
                <x-input label="Password" wire:model="password_confirmation" type="password" />
             
                <x-slot:actions>
                    <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
            
        </x-card>
    </div>
</div>
