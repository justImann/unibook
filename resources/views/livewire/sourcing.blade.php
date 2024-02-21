<div>
    <!-- HEADER -->
    <x-header title="Pengadaan Buku" >
      <x-slot:actions>
        <x-theme-toggle class="btn" />
      </x-slot:actions>
    </x-header>

    <!-- TABLE  -->
    <x-card>
        <x-header title="Daftar Buku" class="bg-primary-content p-4 rounded" subtitle="*Berikut adalah laporan buku yang perlu segera dibeli berdasarkan stok lebih sedikit" separator progress-indicator > 
            <x-slot:middle class="!justify-end">
                <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
            </x-slot:middle>
        </x-header>

        @foreach ($books as $book)
        <x-list-item :item="$book" class="cursor-pointer" onclick="info{{ $book->uuid }}.showModal()">
            <x-slot:avatar>
                @if ($loop->iteration <= 10)
                    <x-badge value="#{{ $loop->iteration }}" class="badge-primary" />
                @else
                    <x-badge value="#{{ $loop->iteration }}" class="badge-ghost" />
                @endif
            </x-slot:avatar>
            <x-slot:value>
                {{ $book['name'] }} - <span class="text-gray-500 font-normal">{{ $book['stocks'] }}</span> 
            </x-slot:value>
            <x-slot:sub-value>
                {{ $book->publisher->name }}
            </x-slot:sub-value>
        </x-list-item>
        <x-modal id="info{{ $book->uuid }}">
                <x-header title="Tentang buku {{ $book['name'] }}" subtitle="Sisa stok: {{ $book['stocks'] }}" size="text-2xl">
                    <x-slot:actions>
                        @if ($loop->iteration <= 10)
                            <div class="badge badge-error">TOP 10</div>
                        @endif
                    </x-slot:actions>
                </x-header>
                <div class="overflow-x-auto">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th class="w-28">#{{ $book['uuid'] }}</th>
                        </tr>
                        <tr>
                          <th class="w-28">Nama</th>
                          <td>: {{ $book['name'] }}</td>
                        </tr>
                        <tr>
                          <th class="w-28">Penerbit</th>
                          <td>: {{ $book->publisher->name }}</td>
                        </tr>
                        <tr>
                          <th class="w-28">Kategori</th>
                          <td>: {{ $book['category'] }}</td>
                        </tr>
                        <tr>
                          <th class="w-28">Harga</th>
                          <td>: Rp. {{ $book['price'] }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <x-slot:actions>
                    <x-button label="Tutup" onclick="info{{ $book->uuid }}.close()" />
                </x-slot:actions>
        </x-modal>
        @endforeach
    </x-card>
</div>
