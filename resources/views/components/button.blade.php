@php
    $color = $attributes->get('color', 'gray');
@endphp

<button 
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center text-center mb-1 sm:mx-px py-2 sm:px-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest w-2/3 sm:w-auto focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 bg-' . $color . '-600 hover:bg-' . $color . '-500 focus:bg-' . $color . '-500 active:bg-' . $color . '-700 focus:ring-' . $color . '-500'
    ]) }}
>
    {{ $slot }}
</button>
