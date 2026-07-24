@props([
'title'=>null,
])

<section
{{ $attributes }}
>

@if($title)

<h2 class="text-lg font-semibold mb-4">

{{ $title }}

</h2>

@endif

{{ $slot }}

</section>