<!-- Componente de Blade con Tailwind para mostrar y gestionar un carrito de compras. -->
<div>
    <button @click="open = !open"
        class="fixed top-0 right-0 mt-2 me-8 bg-gray-800 text-white rounded-full p-2 focus:outline-none">
        <svg class="h-8 w-8" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path
                d="M1.75 1.002a.75.75 0 1 0 0 1.5h1.835l1.24 5.113A3.752 3.752 0 0 0 2 11.25c0 .414.336.75.75.75h10.5a.75.75 0 0 0 0-1.5H3.628A2.25 2.25 0 0 1 5.75 9h6.5a.75.75 0 0 0 .73-.578l.846-3.595a.75.75 0 0 0-.578-.906 44.118 44.118 0 0 0-7.996-.91l-.348-1.436a.75.75 0 0 0-.73-.573H1.75ZM5 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM13 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z">
            </path>
        </svg>
    </button>

    <!-- Contenedor del resumen del carrito -->
    <div x-show="open" @click.away="open = false"
        class="bg-white w-64 shadow transform translate-x-0 transition-transform ease-in-out duration-300 fixed inset-y-0 right-0 overflow-y-auto">
        <button @click="open = !open"
            class="fixed top-0 right-0 m-4 bg-gray-100 text-black/80 rounded p-2 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Contenido del resumen del carrito -->
        <div class="p-4">
            <h1 class="text-3xl font-bold mb-4">Resumen</h1>

            <!-- Mensaje si el carrito está vacío -->
            @if (count($cartItems) === 0)
                <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                    <p class="font-bold">No hay productos seleccionados.</p>
                    <p>Revisa nuestro catalogo para poder continuar.</p>
                </div>
            @else
                <!-- Listado de productos en el carrito -->
                <ul>
                    @foreach ($cartItems as $cartItem)
                        <li class="mb-2 border-b">
                            <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                            <div class="flex items-center justify-between ">
                                <h2 class="font-bold text-2xl">{{ $cartItem['name'] }} </h2>
                                <button wire:click="deleteFromCart({{ $cartItem['product_id'] }})"
                                    class="mt-2 bg-red-500 hover:bg-red-600 text-white py-2 px-2  focus:outline-none rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-gray-600"><b>Precio unitario:</b> ${{ number_format($cartItem['price'], 2) }}</p>
                            <p class="text-gray-600"><b>Precio a pagar:</b> ${{ number_format($cartItem['total'], 2) }}</p>
                            <p class="text-gray-600"><b>Cantidad:</b> {{ $cartItem['quantity'] }} de
                                {{ $cartItem['stock'] }}
                                disponibles</p>
                            <div class="flex items-center justify-between ">
                                <button @if ($cartItem['quantity'] === $cartItem['stock']) disabled @endif
                                    wire:click="addToCart({{ $cartItem['product_id'] }})"
                                    class="mt-2 bg-slate-400 hover:bg-slate-600 text-white py-2 px-8 rounded focus:outline-none">+</button>
                                <button wire:click="removeFromCart({{ $cartItem['product_id'] }})"
                                    class="mt-2 bg-slate-400 hover:bg-slate-600 text-white py-2 px-8 rounded focus:outline-none">-</button>
                            </div>

                        </li>
                    @endforeach
                    <hr class="h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <h1 class="text-2xl font-bold">Total: ${{ number_format($total, 2) }}</h1>
                    <form wire:submit.prevent="processPayment">
                        <div class="w-full mt-2">
                            <button
                                class="w-full bg-blue-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">
                                Pagar carrito
                            </button>
                        </div>
                    </form>
                </ul>
            @endif
        </div>
    </div>
</div>