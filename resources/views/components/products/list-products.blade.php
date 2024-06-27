<!-- Componente de Blade con Tailwind para mostrar La lista de productos del ecommerce. -->
<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    @if ($products->count() === 0)
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4">
            <p class="font-bold">Gracias por tu preferencia!!!</p>
            <p>Muy pronto tendras mas productos disponibles.</p>
        </div>
    @endif
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        @foreach ($products as $product)
            <div class="group">
                <div
                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                    <img src="{{ $product->image_url ?? null }}" alt="{{ $product->name }}"
                        class="h-full w-full object-cover object-center ">
                </div>
                <h3 class="mt-4 text-3xl font-bold text-gray-700">{{ $product->name }}</h3>
                <p class="mt-1 text-lg font-medium text-gray-900">$ {{ number_format($product->price, 2) }}</p>
                <div class="flex items-center justify-between ">
                    <h3 class="mt-4 text-sm text-gray-700"><b>Disponibles:</b> {{ $product->stock }}</h3>
                    <button wire:click="addToCart({{ $product->id }})" @click="open = true"
                        class="mt-2 bg-blue-500 hover:bg-blue-600 text-white py-2 px-1 rounded focus:outline-none">
                        <svg class="h-6 w-16" data-slot="icon" fill="currentColor" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M1.75 1.002a.75.75 0 1 0 0 1.5h1.835l1.24 5.113A3.752 3.752 0 0 0 2 11.25c0 .414.336.75.75.75h10.5a.75.75 0 0 0 0-1.5H3.628A2.25 2.25 0 0 1 5.75 9h6.5a.75.75 0 0 0 .73-.578l.846-3.595a.75.75 0 0 0-.578-.906 44.118 44.118 0 0 0-7.996-.91l-.348-1.436a.75.75 0 0 0-.73-.573H1.75ZM5 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM13 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
