<div class="p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Gestão de Produtos</h1>
        <button wire:click="openCreate" class="px-4 py-2 bg-indigo-600 text-white rounded">
            Novo Produto
        </button>
    </div>

    <table class="w-full border text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Imagem</th>
                <th class="p-3">Nome</th>
                <th class="p-3">Preço</th>
                <th class="p-3">Estado</th>
                <th class="p-3">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $p)
                <tr class="border-t">
                    <td class="p-3">
                        @if($p->image)
                            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <div class="w-16 h-12 bg-gray-100 flex items-center justify-center text-xs text-gray-500 rounded">
                                sem imagem
                            </div>
                        @endif
                    </td>
                    <td class="p-3">{{ $p->name }}</td>
                    <td class="p-3">{{ $p->price }} MT</td>
                    <td class="p-3">{{ $p->is_active ? 'Ativo' : 'Inativo' }}</td>
                    <td class="p-3 flex gap-4">
                        <button wire:click="openEdit({{ $p->id }})" class="text-blue-600">Editar</button>
                        <button wire:click="delete({{ $p->id }})" class="text-red-600">Apagar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>


    @if($modal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-xl w-full max-w-lg">

                <h2 class="text-xl font-bold mb-4">
                    {{ $editing ? 'Editar Produto' : 'Novo Produto' }}
                </h2>

                <div class="space-y-3">

                    <input type="text" wire:model="name" class="w-full border p-2" placeholder="Nome">

                    <textarea wire:model="description" class="w-full border p-2" placeholder="Descrição"></textarea>

                    <input type="number" step="0.01" wire:model="price" class="w-full border p-2" placeholder="Preço">
                    @if($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" class="w-20 h-20 object-cover">
                    @elseif($image)
                        <img src="{{ asset('storage/' . $image) }}" class="w-20 h-20 object-cover">
                    @endif

                    <input type="file" wire:model="newImage" class="w-full border p-2">

                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_active">
                        Ativo
                    </label>

                </div>

                <div class="flex justify-end mt-6 gap-3">
                    <button wire:click="$set('modal', false)" class="px-4 py-2 bg-gray-300 rounded">
                        Cancelar
                    </button>

                    <button wire:click="save" class="px-4 py-2 bg-green-600 text-white rounded">
                        Guardar
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
