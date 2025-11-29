<!-- Modal do Carrinho -->
<div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-end p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl w-full max-w-md h-screen max-h-screen shadow-2xl transform transition-all flex flex-col">

        <!-- Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-t-2xl">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Meu Carrinho
            </h2>
            <button
                onclick="closeCartModal()"
                class="text-white hover:text-gray-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Items -->
        <div class="flex-1 overflow-y-auto p-6">
            <div id="cartItemsContainer">
                @if(empty($cartItems))
                    <div class="flex flex-col items-center justify-center h-full text-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="text-gray-500 font-medium">Seu carrinho está vazio</p>
                        <p class="text-sm text-gray-400 mt-1">Adicione produtos para começar a comprar</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                            <div class="flex gap-4 pb-4 border-b border-gray-200">
                                <!-- Imagem -->
                                <div class="w-20 h-20 flex-shrink-0">
                                    @if($item['image'] && !empty($item['image']))
                                        <img
                                            src="{{ asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}"
                                            class="w-full h-full object-cover rounded-lg bg-gray-100"
                                            onerror="this.src='{{ asset('images/no-image.png') }}'">
                                    @else
                                        <div class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Quantidade: <span class="font-medium">{{ $item['quantity'] }}</span></p>
                                    <p class="text-indigo-600 font-bold mt-2">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} MT</p>
                                </div>

                                <!-- Remove Button -->
                                <button
                                    wire:click="removeItem({{ $item['id'] }})"
                                    class="text-red-500 hover:text-red-700 transition p-2 flex-shrink-0"
                                    title="Remover do carrinho">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        @if(!empty($cartItems))
            <div class="border-t border-gray-200 p-6 bg-gray-50 rounded-b-2xl space-y-4">
                <!-- Total -->
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <span class="text-gray-600 font-semibold">Subtotal:</span>
                    <span class="text-gray-800 font-bold text-lg">
                        {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cartItems)), 2, ',', '.') }} MT
                    </span>
                </div>

                <!-- Botões -->
                <div class="space-y-2">
                    <a href="{{ route('checkout') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition text-center">
                        Ir para o Checkout
                    </a>
                    <button
                        onclick="closeCartModal()"
                        class="w-full px-4 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:border-gray-400 transition">
                        Continuar Comprando
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function openCartModal() {
        const modal = document.getElementById('cartModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        // Animação de entrada
        const modalContent = modal.querySelector('.bg-white');
        modalContent.style.transform = 'translateX(0)';
        modalContent.style.opacity = '1';
    }

    function closeCartModal() {
        const modal = document.getElementById('cartModal');
        const modalContent = modal.querySelector('.bg-white');

        // Animação de saída
        modalContent.style.transform = 'translateX(100%)';
        modalContent.style.opacity = '0';

        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    // Fechar ao clicar no backdrop
    document.addEventListener('DOMContentLoaded', function() {
        const cartModal = document.getElementById('cartModal');
        if (cartModal) {
            cartModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeCartModal();
                }
            });
        }
    });

    // Fechar com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCartModal();
        }
    });
</script>
@endpush
