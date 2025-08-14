@props(['as' => null])
@if ($as ?? false)
<button {{ $attributes->merge(['class' => "rounded text-xs cursor-pointer font-semibold flex transition duration-300 justify-center items-center
    p-2"]) }}>{{ $slot
    }} </button>
@else
<a {{ $attributes->merge(['class' => "rounded text-xs cursor-pointer font-semibold flex transition duration-300 justify-center items-center
    p-2"]) }}>{{ $slot
    }} </a>
@endif
