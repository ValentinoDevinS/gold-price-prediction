@props([
    'title',
    'description' => null,
])

<div class="border-b border-gray-200 px-6 py-4">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-lg font-semibold">

                {{ $title }}

            </h2>

            @if($description)

                <p class="mt-1 text-sm text-gray-500">

                    {{ $description }}

                </p>

            @endif

        </div>

        {{ $actions ?? '' }}

    </div>

</div>