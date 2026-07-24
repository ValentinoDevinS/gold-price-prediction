@props([
    'label',
    'value' => null,
])

<div class="grid grid-cols-3 gap-4 py-3">

    <dt class="font-medium text-gray-600">

        {{ $label }}

    </dt>

    <dd class="col-span-2 text-gray-900 break-words">

        @if($slot->isNotEmpty())

            {{ $slot }}

        @else

            {{ filled($value) ? $value : '-' }}

        @endif

    </dd>

</div>