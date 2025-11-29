@extends('layouts.app')

@section('title', 'Checkout - TV Sucesso')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600 mt-2">Revise seu pedido e finalize a compra</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Summary -->
            <div class="lg:col-span-2">
                <!-- Items Review -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo do Pedido</h2>

                    <div class="space-y-4">
                        @foreach($cartItems as $item)
                        <div class="flex gap-4 pb-4 border-b border-gray-200 last:border-b-0">
                            @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover rounded-lg">
                            @else
                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif

                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">Quantidade: {{ $item->quantity }}</p>
                                <p class="text-indigo-600 font-bold mt-2">{{ number_format($item->price * $item->quantity, 2, ',', '.') }} MT</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Dados de Entrega</h2>

                    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4" id="checkoutForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                                <input type="text" id="full_name" name="full_name" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('full_name', auth()->user()->name) }}">
                                @error('full_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email', auth()->user()->email) }}">
                                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="tel" id="phone" name="phone" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="(+258) 84 123 4567">
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" id="address" name="address" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Rua, número, complemento">
                            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Cidade</label>
                                <input type="text" id="city" name="city" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                @error('city') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de Pagamento</label>
                                <select id="payment_method" name="payment_method" required class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Selecione um método</option>
                                    <option value="visa">Cartão Visa</option>
                                    <option value="m_pesa">M-Pesa</option>
                                    <option value="e_mola">E-mola</option>
                                </select>
                                @error('payment_method') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Campo para Visa Card -->
                        <div id="visaCardField" class="hidden p-4 bg-purple-50 rounded-lg border border-purple-200">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm12 4v4a2 2 0 002-2v-4a2 2 0 00-2 2zm0 0V6a2 2 0 012 2v4a2 2 0 01-2 2z" />
                                </svg>
                                Dados do Cartão
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Número do Cartão</label>
                                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" maxlength="19">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-1">Validade (MM/YY)</label>
                                        <input type="text" id="card_expiry" name="card_expiry" placeholder="12/25" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" maxlength="5">
                                    </div>
                                    <div>
                                        <label for="card_cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                        <input type="text" id="card_cvv" name="card_cvv" placeholder="123" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" maxlength="4">
                                    </div>
                                </div>

                                <div>
                                    <label for="card_holder" class="block text-sm font-medium text-gray-700 mb-1">Titular do Cartão</label>
                                    <input type="text" id="card_holder" name="card_holder" placeholder="JOÃO SILVA" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>

                                <p class="text-xs text-purple-700 bg-purple-100 p-2 rounded">
                                    <strong>Simulação:</strong> Como este é um ambiente de teste, preencha os dados normalmente. Não realizamos validação de cartão.
                                </p>
                            </div>
                        </div>

                        <!-- Campo para Número M-Pesa/E-mola -->
                        <div id="mobileNumberField" class="hidden p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <label for="mobile_number" class="block text-sm font-medium text-gray-700 mb-2">
                                <span id="mobileLabel">Número M-Pesa/E-mola</span>
                            </label>
                            <input type="tel" id="mobile_number" name="mobile_number" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="84 123 4567">
                            <p class="text-xs text-gray-600 mt-2">
                                <span id="mobileHint">Insira seu número M-Pesa ou E-mola válido</span>
                            </p>
                            <p id="mobileError" class="text-xs text-red-600 mt-2 hidden"></p>
                        </div>

                        <!-- Payment Methods Display -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-sm font-medium text-gray-700 mb-3">Métodos de Pagamento Disponíveis:</p>
                            <div class="flex items-center gap-4 flex-wrap">
                                <div class="flex flex-col items-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-8 opacity-70 mb-1">
                                    <span class="text-xs text-gray-600">Visa</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <img src="{{ asset('m-pesa.png') }}" alt="M-Pesa" class="h-9 opacity-70 mb-1">
                                    <span class="text-xs text-gray-600">M-Pesa</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <img src="{{ asset('emola.png') }}" alt="E-mola" class="h-10 opacity-70 mb-1">
                                    <span class="text-xs text-gray-600">E-mola</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition mt-6">
                            Confirmar Pedido
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Total -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>

                    <div class="space-y-3 border-b border-gray-200 pb-4 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-semibold">{{ number_format($total, 2, ',', '.') }} MT</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Frete:</span>
                            <span class="font-semibold text-green-600">Grátis</span>
                        </div>
                    </div>

                    <div class="flex justify-between mb-6">
                        <span class="text-lg font-bold text-gray-900">Total:</span>
                        <span class="text-lg font-bold text-indigo-600">{{ number_format($total, 2, ',', '.') }} MT</span>
                    </div>

                    <a href="/" class="block w-full px-4 py-2 text-center text-indigo-600 border-2 border-indigo-600 rounded-lg hover:bg-indigo-50 transition mb-2">
                        Continuar Comprando
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.getElementById('payment_method');
    const visaCardField = document.getElementById('visaCardField');
    const mobileNumberField = document.getElementById('mobileNumberField');
    const mobileNumberInput = document.getElementById('mobile_number');
    const mobileLabel = document.getElementById('mobileLabel');
    const mobileHint = document.getElementById('mobileHint');
    const mobileError = document.getElementById('mobileError');
    const form = document.getElementById('checkoutForm');

    // Validar número conforme o método (APENAS para M-Pesa e E-mola)
    function validatePhoneNumber(value, method) {
        const cleanValue = value.replace(/\D/g, '');

        if (!cleanValue) {
            return { valid: false, message: 'Número obrigatório' };
        }

        if (cleanValue.length !== 9) {
            return { valid: false, message: 'O número deve ter exatamente 9 dígitos' };
        }

        const firstTwo = cleanValue.slice(0, 2);

        if (method === 'm_pesa') {
            if (firstTwo === '84' || firstTwo === '85') {
                return { valid: true, message: '' };
            } else {
                return { valid: false, message: 'Número M-Pesa deve começar com 84 ou 85' };
            }
        } else if (method === 'e_mola') {
            if (firstTwo === '86' || firstTwo === '87') {
                return { valid: true, message: '' };
            } else {
                return { valid: false, message: 'Número E-mola deve começar com 86 ou 87' };
            }
        }

        return { valid: false, message: 'Método inválido' };
    }

    // Mostrar/Ocultar campos conforme o método selecionado
    paymentMethodSelect.addEventListener('change', function() {
        const selectedMethod = this.value;

        if (selectedMethod === 'visa') {
            visaCardField.classList.remove('hidden');
            mobileNumberField.classList.add('hidden');
            mobileNumberInput.required = false;
            mobileNumberInput.value = '';
            mobileError.classList.add('hidden');
        } else if (selectedMethod === 'm_pesa') {
            visaCardField.classList.add('hidden');
            mobileNumberField.classList.remove('hidden');
            mobileLabel.textContent = 'Número M-Pesa';
            mobileHint.textContent = 'Insira um número M-Pesa válido começando com 84 ou 85 (9 dígitos)';
            mobileNumberInput.placeholder = '84 123 4567';
            mobileNumberInput.required = true;
            mobileError.classList.add('hidden');
        } else if (selectedMethod === 'e_mola') {
            visaCardField.classList.add('hidden');
            mobileNumberField.classList.remove('hidden');
            mobileLabel.textContent = 'Número E-mola';
            mobileHint.textContent = 'Insira um número E-mola válido começando com 86 ou 87 (9 dígitos)';
            mobileNumberInput.placeholder = '86 123 4567';
            mobileNumberInput.required = true;
            mobileError.classList.add('hidden');
        } else {
            visaCardField.classList.add('hidden');
            mobileNumberField.classList.add('hidden');
            mobileNumberInput.required = false;
            mobileNumberInput.value = '';
            mobileError.classList.add('hidden');
        }
    });

    // Formatar número de cartão
    document.getElementById('card_number').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        let formattedValue = '';
        for (let i = 0; i < value.length; i += 4) {
            if (i > 0) formattedValue += ' ';
            formattedValue += value.substr(i, 4);
        }
        this.value = formattedValue;
    });

    // Formatar validade
    document.getElementById('card_expiry').addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length >= 2) {
            this.value = value.slice(0, 2) + '/' + value.slice(2, 4);
        } else {
            this.value = value;
        }
    });

    // Formatar CVV (apenas números)
    document.getElementById('card_cvv').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    // Formatar número de telefone
    mobileNumberInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');

        if (value.length > 0) {
            if (value.length <= 2) {
                this.value = value;
            } else if (value.length <= 5) {
                this.value = value.slice(0, 2) + ' ' + value.slice(2);
            } else {
                this.value = value.slice(0, 2) + ' ' + value.slice(2, 5) + ' ' + value.slice(5, 9);
            }
        }

        mobileError.classList.add('hidden');
    });

    // Validar número ao sair do campo
    mobileNumberInput.addEventListener('blur', function() {
        const selectedMethod = paymentMethodSelect.value;

        if (selectedMethod === 'm_pesa' || selectedMethod === 'e_mola') {
            const validation = validatePhoneNumber(this.value, selectedMethod);

            if (!validation.valid && this.value) {
                mobileError.textContent = validation.message;
                mobileError.classList.remove('hidden');
                this.classList.add('border-red-500');
            } else {
                mobileError.classList.add('hidden');
                this.classList.remove('border-red-500');
            }
        }
    });

    // Validar antes de enviar
    form.addEventListener('submit', function(e) {
        const selectedMethod = paymentMethodSelect.value;

        if (selectedMethod === 'm_pesa' || selectedMethod === 'e_mola') {
            const validation = validatePhoneNumber(mobileNumberInput.value, selectedMethod);

            if (!validation.valid) {
                e.preventDefault();
                mobileError.textContent = validation.message;
                mobileError.classList.remove('hidden');
                mobileNumberInput.classList.add('border-red-500');
                mobileNumberInput.focus();
            }
        }
    });
});
</script>
@endsection
