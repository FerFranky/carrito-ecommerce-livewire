<!-- Componente de Blade con Tailwind para mostrar un mensaje de success. -->
@if (session()->has('payment'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Gracias por tu preferencia!!!</p>
        <p class="text-sm">{{ session('payment') }}</p>
    </div>
@endif
