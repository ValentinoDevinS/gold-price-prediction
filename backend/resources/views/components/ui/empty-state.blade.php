@props([
'icon'=>'📄',
'title'=>'No Data',
'description'=>'No records found.',
])

<div class="py-16 text-center">

<div class="text-5xl">

{{ $icon }}

</div>

<h3 class="mt-4 text-lg font-semibold">

{{ $title }}

</h3>

<p class="mt-2 text-gray-500">

{{ $description }}

</p>

{{ $slot }}

</div>