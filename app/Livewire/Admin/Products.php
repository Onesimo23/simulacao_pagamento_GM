<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Products extends Component {
    use WithPagination, WithFileUploads;

    public $modal = false;
    public $editing = false;

    public $productId;
    public $name;
    public $description;
    public $price;
    public $image;
    public $newImage;
    public $is_active = true;

    public function openCreate() {
        $this->resetForm();
        $this->modal = true;
        $this->editing = false;
    }

    public function openEdit($id) {
        $p = Product::findOrFail($id);

        $this->productId = $p->id;
        $this->name = $p->name;
        $this->description = $p->description;
        $this->price = $p->price;
        $this->image = $p->image;
        $this->is_active = $p->is_active;

        $this->editing = true;
        $this->modal = true;
    }

    public function save() {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'newImage' => 'nullable|image|max:5120',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
        ];

        if ($this->newImage) {
            if ($this->editing && $this->image) {
                Storage::disk('public')->delete($this->image);
            }

            $path = $this->newImage->store('products', 'public');
            $data['image'] = $path;
        }

        if ($this->editing) {
            Product::findOrFail($this->productId)->update($data);
        } else {
            Product::create($data);
        }

        $this->modal = false;
        $this->resetForm();
    }

    public function delete($id) {
        $p = Product::findOrFail($id);

        if ($p->image) {
            Storage::disk('public')->delete($p->image);
        }

        $p->delete();
    }

    public function resetForm() {
        $this->productId = null;
        $this->name = null;
        $this->description = null;
        $this->price = null;
        $this->image = null;
        $this->newImage = null;
        $this->is_active = true;
    }

    public function render() {
        return view('livewire.admin.products', [
            'products' => Product::latest()->paginate(10),
        ])->layout('layouts.app');
    }
}
