<!-- Componente de Blade con Tailwind contenedor de todos los partials de la vista del ecommerce. -->
<div class="relative" x-data="{ open: false }">
    @include('components.navigation.navbar')
    @include('components.cart.cart-offcanvas')
    <div>
        @include('components.notifications.payment-success')
        @include('components.notifications.payment-error')
    </div>
    @include('components.products.list-products')
</div>
