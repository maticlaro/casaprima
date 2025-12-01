<section class=" border-[#e3e3e0] w-full py-14 lg:py-24 border rounded-lg" id="services-grid" >
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-[#1b1b18] mb-8 text-center" style="font-family: 'Playfair Display', serif;">
            Servicios Destacados
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $featuredServices = \App\Models\Service::where('home_featured', true)
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->take(3)
                    ->get();
            @endphp
            @foreach($featuredServices as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>
        <div class="flex justify-center mt-10">
            <a href="/servicios" class="bg-[#B28A5B] text-white font-semibold px-8 py-3 rounded-lg shadow-lg text-lg hover:bg-[#a07a4e] transition">
                Ver todos los servicios
            </a>
        </div>
    </div>
</section>
