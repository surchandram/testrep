@props([
    'outlined' => false,
    'rounded' => '',
    'borders' => '',
    'bg' => 'bg-primary',
    'size' => 'px-4 py-2',
    'defaultStyles' => 'inline-flex items-center justify-center text-center font-medium text-white hover:bg-opacity-90',
])
@php
    switch ($size) {
        case 'xs':
            $size = 'px-2 py-1';
            break;
    
        case 'lg':
            $size = 'py-4 px-10 lg:px-8 xl:px-10';
            break;
    
        case 'sm':
            $size = 'px-4 py-2';
            break;
    
        default:
            $size = empty($size) ? 'px-4 py-2' : $size;
            break;
    }

    switch ($rounded) {
        case 'md':
            $rounded = 'rounded-md';
            break;
    
        case 'full':
            $rounded = 'rounded-full';
            break;
    
        default:
            if ($outlined == true) {
                $rounded = 'rounded-md';
            }
            break;
    }

    switch ($bg) {
        case 'teal':
            $bg = 'bg-meta-3';
            break;
        
        case 'success':
            $bg = 'bg-success';
            break;
        
        case 'secondary':
            $bg = 'bg-black';
            break;

        default:
            $bg = empty($bg) ? 'bg-primary' : $bg;
            break;
    }

    $outlineText = '';

    if ($outlined) {
        switch ($outlined) {
            case 'success':
                $borders = "border border-meta-3";
                $outlineText = 'text-meta-3';
                break;
            
            case 'secondary':
                $borders = "border border-black";
                $outlineText = 'text-black';
                break;
            
            default:
                $borders = "border border-primary";
                $outlineText =  'text-primary';
                break;
        }
    }

    if ($isText) {
        $outlined = true;
        $borders = '';
    }
@endphp
@if (!empty($outlined))
    <button
        {{ $attributes->merge(['class' => "inline-flex items-center justify-center text-center font-medium hover:bg-opacity-90 $outlineText $rounded $size $borders"]) }}>
        {{ $slot }}
    </button>
@else
    <button {{ $attributes->merge(['class' => "$defaultStyles $bg $rounded $size"]) }}>
        {{ $slot }}
    </button>
@endif
