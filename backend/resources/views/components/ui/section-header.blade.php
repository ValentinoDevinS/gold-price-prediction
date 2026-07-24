@props([
'title',
'description'=>null,
])

<div class="mb-6">

<h2 class="text-xl font-semibold">

{{ $title }}

</h2>

@if($description)

<p class="text-gray-500 mt-1">

{{ $description }}

</p>

@endif

</div>