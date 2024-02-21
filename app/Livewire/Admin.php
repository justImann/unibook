<?php

namespace App\Livewire;

use App\Models\Book;
use Mary\Traits\Toast;
use Livewire\Component;
use App\Models\Publisher;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

class Admin extends Component
{
    use Toast;

    use WithPagination;
    public string $search = '';

    public bool $drawerBook = false;
    public bool $modalBook = false;
    public bool $modalPub = false;

    public bool $drawerPublisher = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Edit vars
    public $editBookId, $editPublisherId;

    // Book vars
    public $bookName, $price, $stocks, $category, $publisher_id;

    // Publisher vars
    public $publisherName, $city, $address, $phone_number;

    // Save Book
    public function saveBook(): void
    {
        $this->validate([
            'bookName' => 'required|string|min:2',
            'category' => 'required',
            'stocks' => 'required|max:10000',
            'price' => 'required',
            'publisher_id' => 'required',
        ]);

        Book::create([
            'uuid' => 'K' . fake()->numerify('###'),
            'name' => $this->bookName,
            'category' => $this->category,
            'stocks' => $this->stocks,
            'price' => $this->price,
            'publisher_id' => $this->publisher_id,
        ]);

        $this->success('Buku baru ditambah!', position: 'toast-bottom');
        $this->reset();
    }

    // Edit Book
    public function editBook($id): void
    {
        $this->editBookId = $id;
        $this->bookName = Book::find($id)->name;
        $this->price = Book::find($id)->price;
        $this->stocks = Book::find($id)->stocks;
        $this->category = Book::find($id)->category;
        $this->publisher_id = Book::find($id)->publisher_id;
        $this->modalBook = true;
        $this->info("edit data buku #$id", position: 'toast-bottom');
    }

    // Update book
    public function updateBook(): void
    {
        $this->validate([
            'bookName' => 'required|string|min:2',
            'category' => 'required',
            'stocks' => 'required|max:10000',
            'price' => 'required',
            'publisher_id' => 'required',
        ]);

        Book::find($this->editBookId)->update([
            'uuid' => 'K' . fake()->numerify('###'),
            'name' => $this->bookName,
            'category' => $this->category,
            'stocks' => $this->stocks,
            'price' => $this->price,
            'publisher_id' => $this->publisher_id,
        ]);

        $this->success("Buku $this->bookName berhasil di edit!", position: 'toast-bottom');
        $this->reset();
    }

    // Save Buku
    public function savePub(): void
    {
        $this->validate([
            'publisherName' => 'required|string|min:2|max:55',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required',
        ]);

        Publisher::create([
            'uuid' => 'SP' . fake()->numerify('###'),
            'name' => $this->publisherName,
            'address' => $this->address,
            'city' => $this->city,
            'phone_number' => $this->phone_number,
        ]);

        $this->success('Penerbit baru ditambah!', position: 'toast-bottom');
        $this->reset();
    }
    // Edit Buku
    public function editPub($id): void
    {
        $this->editPublisherId = $id;
        $this->publisherName = Publisher::find($id)->name;
        $this->address = Publisher::find($id)->address;
        $this->city = Publisher::find($id)->city;
        $this->phone_number = Publisher::find($id)->phone_number;
        $this->modalPub = true;
        $this->info("edit data penerbit #$id", position: 'toast-bottom');
    }

    public function updatePub(): void
    {
        $this->validate([
            'publisherName' => 'required|string|min:2|max:55',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required',
        ]);

        Publisher::find($this->editPublisherId)->update([
            'name' => $this->publisherName,
            'address' => $this->address,
            'city' => $this->city,
            'phone_number' => $this->phone_number,
        ]);

        $this->success("Penerbit $this->publisherName berhasil diedit!", position: 'toast-bottom');
        $this->reset();
    }

    // Clear filters
    public function cancelEdit(): void
    {
        $this->reset();
        $this->warning('Cancel Edit.', position: 'toast-bottom');
    }

    // Delete action
    public function deleteBook($id): void
    {
        Book::find($id)->delete();
        $this->warning("Buku #$id", 'Telah dihapus.', position: 'toast-bottom');
    }
    public function deletePub($id): void
    {
        Publisher::find($id)->delete();
        $this->warning("Publiher #$id", 'Telah dihapus dengan buku-bukunya.', position: 'toast-bottom');
    }

    // // Table headers
    public function bookHeaders(): array
    {
        return [
            ['key' => 'uuid', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-36'],
            ['key' => 'category', 'label' => 'Kategori Buku', 'class' => 'w-20'],
            ['key' => 'price', 'label' => 'Harga', 'class' => 'w-20'],
            ['key' => 'stocks', 'label' => 'Stok', 'class' => 'w-10'],
            ['key' => 'publisher', 'label' => 'Penerbit', 'class' => 'w-24', 'sortable' => false],
        ];
    }
    public function pubHeaders(): array
    {
        return [
            ['key' => 'uuid', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-36'],
            ['key' => 'address', 'label' => 'Alamat', 'class' => 'w-20'],
            ['key' => 'city', 'label' => 'Kota', 'class' => 'w-20'],
            ['key' => 'phone_number', 'label' => 'No Handphone', 'class' => 'w-20'],
            ['key' => 'stocks', 'label' => 'Jumlah Buku', 'class' => 'w-10', 'sortable' => false],
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
        return Book::latest()
            ->where('name', 'like', "%$this->search%")
            ->orWhere('category', 'like', "%$this->search%")
            ->orWhere('uuid', 'like', "%$this->search%")
            ->get();
    }
    public function publishers(): Collection
    {
        return Publisher::latest()
            ->where('name', 'like', "%$this->search%")
            ->orWhere('address', 'like', "%$this->search%")
            ->orWhere('city', 'like', "%$this->search%")
            ->get();
    }

    public function render()
    {
        return view('livewire.admin', [
            'books' => $this->books(),
            'publishers' => $this->publishers(),
            'bookHeaders' => $this->bookHeaders(),
            'pubHeaders' => $this->pubHeaders()
        ]);
    }
}
