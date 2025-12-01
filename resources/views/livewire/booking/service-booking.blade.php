<section class="w-full py-8">
    <div class="max-w-5xl mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-top mb-6">
            <div class="md:col-span-1">
                <img src="https://picsum.photos/seed/{{ rand(1,1000) }}/200" alt="{{ $service->name }}" class="w-full h-48 md:h-56 object-cover rounded-lg shadow" />
            </div>
            <div class="md:col-span-2">
                <h1 class="text-2xl font-bold mb-2">{{ $service->name }}</h1>
                <p class="text-gray-600">{{ $service->short_description }}</p>
            </div>
        </div>
        <form wire:submit="create" class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                @if($showRegistrationForm)
                    <livewire:booking.customer-registration />
                @else
                <div class="bg-white rounded-lg shadow p-6">
                    
                        {{ $this->form }}

                        <div class="flex justify-end pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 bg-[#1C2B4B] text-white rounded-lg hover:bg-[#13213a] transition-colors duration-200">
                                Confirmar reserva
                            </button>
                        </div>
                
                </div>
                @endif
            </div>

            <aside class="space-y-4">
                <div class="p-4 bg-white rounded shadow">
                    <h2 class="font-semibold mb-2">Cotización</h2>
                    <div class="text-2xl font-bold">${{ number_format($quote, 0, ',', '.') }} CLP</div>
                </div>
                <button class="w-full bg-[#B28A5B] text-white py-3 rounded hover:bg-[#a07a4e]">Continuar sin pagar</button>
            </aside>
        </div>
        <div>

        </div>
    </form>
    <x-filament-actions::modals />
    </div>
   
</section>



