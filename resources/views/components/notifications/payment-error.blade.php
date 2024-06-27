<!-- Componente de Blade con Tailwind para mostrar un mensaje de error. -->
@if (session()->has('paymentError'))
    <div role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Alerta!!!
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>{{ session('paymentError') }}</p>
        </div>
    </div>
@endif
