@php
    use Illuminate\Support\Facades\Route;

    $routeExists = Route::has($item->route);

    $href = $routeExists
        ? route($item->route)
        : '#';

    $isActive = $routeExists
        ? request()->routeIs($item->route)
        : false;
@endphp

<a
    href="{{ $href }}"
    class="{{ $style()->link($isActive) }}"
    @unless($routeExists)
        aria-disabled="true"
        title="Module not implemented yet"
    @endunless
>
    @if($item->icon)
        <span class="{{ $style()->icon() }}">
            {!! $item->icon !!}
        </span>
    @endif

    <span class="{{ $style()->label() }}">
        {{ $item->label }}
    </span>
</a>