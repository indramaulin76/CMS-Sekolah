@props([
    'title',
    'subtitle' => null,
    'icon' => null, 
])

<div class="container mx-auto px-4 lg:px-8 pt-8 md:pt-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between border-b-2 border-gray-200 dark:border-gray-700 pb-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-primary dark:text-white flex items-center font-display">
                @if($icon)
                    <i class="{{ $icon }} mr-3 text-secondary"></i>
                @elseif(isset($attributes['icon'])) {{-- Fallback if passed as attribute --}}
                    <i class="{{ $attributes['icon'] }} mr-3 text-secondary"></i>
                @endif
                {{ $title }}
            </h1>
            @if($subtitle)
                <p class="text-gray-700 dark:text-gray-200 mt-2 text-sm md:text-base font-light">
                    {{ $subtitle }}
                </p>
            @endif
        </div>
        
        {{-- Allow injecting extra content like buttons on the right --}}
        @if($slot->isNotEmpty())
            <div class="mt-4 md:mt-0">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
