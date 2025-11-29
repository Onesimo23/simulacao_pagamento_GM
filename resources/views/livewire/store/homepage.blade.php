<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100">

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-16 sm:py-24">
            <div class="text-center space-y-6">
                <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold tracking-tight animate-fade-in">
                    Bem-vindo ao sistema de simulação de pagamentos
                </h1>
                <p class="text-xl sm:text-2xl text-indigo-100 max-w-3xl mx-auto">
                    Descubra os melhores produtos ao melhor preço. Qualidade e confiança em cada compra.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <button class="px-8 py-4 bg-white text-indigo-600 rounded-full font-semibold hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                        Ver Ofertas
                    </button>
                    <button class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-indigo-600 transition transform hover:scale-105">
                        Explorar Categorias
                    </button>
                </div>
            </div>
        </div>
        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="white" />
            </svg>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-6 py-16">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">Nossos Produtos</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Destaques da Semana</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 mx-auto rounded-full"></div>
        </div>

        <!-- Filters/Categories (optional) -->
        <div class="flex flex-wrap gap-3 justify-center mb-12">
            <button class="px-6 py-2 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 transition">
                Todos
            </button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition">
                Eletrônicos
            </button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition">
                Moda
            </button>
            <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition">
                Casa
            </button>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($products as $product)
            <div class="group relative bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">

                <!-- Product Image -->
                <div class="relative overflow-hidden bg-gray-100 aspect-square">
                    @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        alt="{{ $product->name }}">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif

                    <!-- Badge/Tag -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold rounded-full shadow-lg">
                            NOVO
                        </span>
                    </div>

                    <!-- Quick View Button -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                        <button onclick="openModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->image ? asset('storage/' . $product->image) : '' }}', '{{ addslashes($product->description) }}', {{ $product->price }})" class="px-6 py-2 bg-white text-gray-900 rounded-full font-semibold opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 shadow-lg">
                            Ver Detalhes
                        </button>
                    </div>

                    <!-- Favorite Icon -->
                    <button class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-red-50 transition opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5 text-gray-600 hover:text-red-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Product Info -->
                <div class="p-6 space-y-3">
                    <!-- Product Name -->
                    <h3 class="text-lg font-bold text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition">
                        {{ $product->name }}
                    </h3>

                    <!-- Product Description -->
                    <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                        {{ $product->description }}
                    </p>

                    <!-- Rating (optional - você pode adicionar depois) -->
                    <div class="flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                            <span class="text-xs text-gray-500 ml-2">(4.0)</span>
                    </div>

                    <!-- Price and Action -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div>
                            <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                {{ number_format($product->price, 2) }} MT
                            </span>
                        </div>
                    </div>

                    <!-- Add to Cart Button no Card - MUDE ISTO -->
                    <button onclick="openModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->image ? asset('storage/' . $product->image) : '' }}', '{{ addslashes($product->description) }}', {{ $product->price }})" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Adicionar ao Carrinho
                    </button>
                </div>
            </div>
            @empty
            <p class="col-span-full text-center text-gray-500">Nenhum produto disponível no momento.</p>
            @endforelse
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-16">
            <button class="px-10 py-4 bg-white border-2 border-indigo-600 text-indigo-600 rounded-full font-semibold hover:bg-indigo-600 hover:text-white transition-all transform hover:scale-105 shadow-lg">
                Carregar Mais Produtos
            </button>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 py-16 mt-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Entrega Rápida</h3>
                    <p class="text-gray-600">Receba seus produtos em até 48 horas</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Compra Segura</h3>
                    <p class="text-gray-600">Seus dados protegidos com SSL</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center group">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Garantia Total</h3>
                    <p class="text-gray-600">30 dias para devolução gratuita</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalhes do Produto -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-2xl transform transition-all">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-3xl z-10">
                <h2 class="text-2xl font-bold text-gray-900">Detalhes do Produto</h2>
                <button onclick="closeModal()" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Imagem do Produto -->
                    <div class="space-y-4">
                        <div class="relative aspect-square rounded-2xl overflow-hidden bg-gray-100 shadow-lg">
                            <img id="modalImage" src="" alt="" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold rounded-full shadow-lg">
                                    DESTAQUE
                                </span>
                            </div>
                        </div>

                        <!-- Imagens em miniatura (opcional - você pode adicionar depois) -->
                        <div class="grid grid-cols-4 gap-2">
                            <div class="aspect-square rounded-lg bg-gray-100 border-2 border-indigo-600 cursor-pointer"></div>
                            <div class="aspect-square rounded-lg bg-gray-100 cursor-pointer hover:border-2 hover:border-indigo-400"></div>
                            <div class="aspect-square rounded-lg bg-gray-100 cursor-pointer hover:border-2 hover:border-indigo-400"></div>
                            <div class="aspect-square rounded-lg bg-gray-100 cursor-pointer hover:border-2 hover:border-indigo-400"></div>
                        </div>
                    </div>

                    <!-- Informações do Produto -->
                    <div class="space-y-6">
                        <div>
                            <h3 id="modalTitle" class="text-3xl font-bold text-gray-900 mb-3"></h3>

                            <!-- Rating -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">(4.0) • 127 avaliações</span>
                            </div>

                            <!-- Preço -->
                            <div class="mb-6">
                                <span id="modalPrice" class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600"></span>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Descrição</h4>
                            <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
                        </div>

                        <!-- Características -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Características</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Entrega rápida</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Garantia 30 dias</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Produto original</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Em estoque</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quantidade -->
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Quantidade</h4>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border-2 border-gray-300 rounded-xl overflow-hidden">
                                    <button onclick="decreaseQuantity()" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 transition text-gray-700 font-bold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity" value="1" min="1" max="99" class="w-20 text-center text-lg font-semibold text-gray-900 border-0 focus:outline-none">
                                    <button onclick="increaseQuantity()" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 transition text-gray-700 font-bold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                                <span class="text-sm text-gray-600">Disponível: <span class="font-semibold text-green-600">50 unidades</span></span>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="space-y-3 pt-4">
                            <button onclick="submitAddToCart()" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl font-bold hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 text-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Adicionar ao Carrinho
                            </button>

                            <button class="w-full bg-white border-2 border-indigo-600 text-indigo-600 py-4 rounded-xl font-bold hover:bg-indigo-50 transition-all flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Adicionar aos Favoritos
                            </button>
                        </div>

                        <!-- Info de Entrega -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 border border-indigo-100">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m-1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900 mb-1">Entrega grátis</h5>
                                    <p class="text-sm text-gray-600">Para compras acima de 1.000,00 MT. Entrega em 2-5 dias úteis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>



    @push('scripts')
    <script>
        let currentProductId = null;

        function openModal(id, name, image, description, price) {
            currentProductId = id;
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalDescription').textContent = description || 'Sem descrição disponível';
            document.getElementById('modalPrice').textContent = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'MZN'
            }).format(price);

            const modalImage = document.getElementById('modalImage');
            modalImage.src = image || 'https://via.placeholder.com/400x400';
            modalImage.alt = name;

            document.getElementById('quantity').value = 1;
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('productModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
            document.getElementById('productModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function increaseQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value) || 1;
            input.value = Math.min(currentValue + 1, 99);
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value) || 1;
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }

        function submitAddToCart() {
            console.log('Enviando para servidor...');
            const qty = parseInt(document.getElementById('quantity').value) || 1;

            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: currentProductId,
                    quantity: qty
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Resposta:', data);
                if (data.success) {
                    alert(data.message);
                    closeModal();
                    location.reload(); 
                } else {
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao adicionar ao carrinho');
            });
        }

        document.getElementById('productModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
    @endpush

</div>
