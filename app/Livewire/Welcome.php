<?php

namespace App\Livewire;

use App\Models\Book;
use Mary\Traits\Toast;
use Livewire\Component;
use Illuminate\Support\Collection;

class Welcome extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        Book::find($id)->delete();
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'uuid', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-24'],
            ['key' => 'category', 'label' => 'Kategori Buku', 'class' => 'w-20'],
            ['key' => 'price', 'label' => 'Harga', 'class' => 'w-20'],
            ['key' => 'stocks', 'label' => 'Stok', 'class' => 'w-10'],
            ['key' => 'publisher', 'label' => 'Penerbit', 'class' => 'w-20', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to Mary docs to see the eloquent examples.
     */
    public function books(): Collection
    {
        return Book::query()
            ->where('name', 'like', "%$this->search%")
            ->orWhere('category', 'like', "%$this->search%")
            ->orWhere('uuid', 'like', "%$this->search%")
            ->orderBy(...array_values($this->sortBy))
            ->get();
    }

    public function render()
    {
        return view('livewire.welcome', [
            'books' => $this->books(),
            'headers' => $this->headers()
        ]);
    }
}
