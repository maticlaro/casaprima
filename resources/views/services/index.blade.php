@php
    use App\Models\ServiceCategory;
    $categories = ServiceCategory::with(['services' => function($q) {
        $q->where('is_active', true);
    }])->get();
@endphp
<x-layouts.mainapp>
<section class="w-full py-4 lg:py-14 " id="services-list">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-8 text-center" style="font-family: 'Playfair Display', serif;">
            Todos los Servicios
        </h2>
        <div class="mb-8 flex justify-center">
            <div class="relative w-full ">
                <input 
                    type="text" 
                    id="service-search" 
                    placeholder="Buscar servicio..." 
                    class="border border-gray-300 rounded-full px-15 py-3 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary transition duration-200 text-lg bg-white"
                    oninput="filterServices()"
                >
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </span>
            </div>
        </div>
        @foreach($categories as $category)
            <div class="mb-10">
                <h3 class="text-2xl font-semibold text-[#1b1b18] mb-6">{{ $category->name }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" data-category="{{ $category->id }}">
                    @foreach($category->services as $service)
                        <x-service-card :service="$service" />
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
</x-layouts.mainapp>

<script>
function filterServices() {
    const search = document.getElementById('service-search').value.toLowerCase();
    document.querySelectorAll('[data-category] .service-card').forEach(card => {
        const name = card.querySelector('h3').textContent.toLowerCase();
        card.style.display = name.includes(search) ? '' : 'none';
    });
}
</script>
