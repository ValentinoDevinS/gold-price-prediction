<div {{ $attributes->merge([
    'class' => 'overflow-x-auto rounded-lg border'
]) }}>

    <table class="min-w-full divide-y divide-gray-200">

        {{ $slot }}

    </table>

</div>