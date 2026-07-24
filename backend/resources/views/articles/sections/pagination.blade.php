@if($articles->hasPages())

<div class="flex justify-end">

    {{ $articles->links() }}

</div>

@endif