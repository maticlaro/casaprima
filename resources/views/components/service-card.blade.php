@props(['service', 'showCta' => true, 'ctaLabel' => 'Agenda ahora'])
<div class="service-card bg-white rounded-xl shadow-md overflow-hidden flex flex-col" style="min-width:220px;">
    <img src="https://picsum.photos/seed/{{ rand(1,1000) }}/200" alt="{{ $service->name }}" class="w-full h-40 object-cover" />
    <div class="p-4 text-center">
        <h3 class="font-semibold text-lg text-[#1b1b18] mb-1">{{ $service->name }}</h3>
        <p class="text-[#2d3a2e] text-sm mb-2">{{ $service->short_description }}</p>
        <div class="text-[#1b1b18] font-semibold">Projects starting at ${{ number_format($service->base_price, 0) }}</div>
    </div>
    @if($showCta)
        <div class="px-4 pb-4 pt-0">
            <a href="{{ route('services.show', ['service' => $service->slug]) }}" class="w-full inline-flex items-center justify-center bg-[#B28A5B] text-white font-semibold px-4 py-2 rounded hover:bg-[#a07a4e] transition">
                {{ $ctaLabel }}
            </a>
        </div>
    @endif
</div>
