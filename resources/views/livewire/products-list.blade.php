<div class="grid grid-cols-3 gap-4">
    @foreach ($products as $product)
        <div class="border p-4 rounded">
            <h3 class="text-xl font-bold">{{ $product->name }}</h3>
            <p>{{ $product->price }} MT</p>

            <button class="bg-blue-500 text-white px-3 py-1 rounded"
                    wire:click="addToCart({{ $product->id }})">
                Adicionar ao carrinho
            </button>
        </div>
    @endforeach
</div>
